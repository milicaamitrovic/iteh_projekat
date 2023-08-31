import { useEffect, useState } from "react";
import "../IzmeniStudenta.css";
import apiService from "../apiService";

const noviRaspored = {
  naziv_rasporeda: "",
  datum_od: "",
  datum_do: "",
  grupa_za_nastavu_id: 1, // admin je default grupa
};

export default function IzmeniRaspored(props) {
  const [error, setError] = useState("");
  const [grupe, setGrupe] = useState([]);

  const editRasporeda = {
    naziv_rasporeda: props.raspored.NazivRasporeda,
    datum_od: props.raspored.DatumOd,
    datum_do: props.raspored.DatumDo,
    grupa_za_nastavu_id: props.raspored.GrupaZaNastavuID,
  };

  const [raspored, setRaspored] = useState(
    props.kreairajNovi ? noviRaspored : editRasporeda
  );

  function handleChange(event) {
    const { name, value } = event.target;

    setRaspored((prevRaspored) => ({
      ...prevRaspored,
      [name]: value,
    }));
  }

  console.log(raspored);
  useEffect(() => {
    apiService
      .getGrupe()
      .then((response) => {
        setGrupe(response.data.data);
      })
      .catch((error) => {
        setError(error.response.data.message);
      });
  }, []);

  return (
    <>
      <div className="modal">
        <form
          onSubmit={(event) => {
            event.preventDefault();
            if (props.kreirajNovog) {
              apiService.createRaspored(raspored).then(() => {
                props.closeModal(true);
              });
            } else {
              apiService
                .updateRaspored(props.raspored.ID, raspored)
                .then(() => {
                  props.closeModal(true);
                });
            }
          }}
        >
          <div className="input-wrapper">
            <label>Naziv rasporeda</label>
            <input
              required
              name="naziv_rasporeda"
              value={raspored.naziv_rasporeda}
              onChange={handleChange}
            />
          </div>

          <div className="input-wrapper">
            <label>Grupa</label>
            <select
              name="grupa_za_nastavu_id"
              value={raspored.grupa_za_nastavu_id}
              onChange={handleChange}
            >
              {grupe.map((grupa) => (
                <option key={grupa.ID} value={grupa.ID}>
                  {grupa.Naziv}
                </option>
              ))}
            </select>
          </div>

          <div className="input-wrapper">
            <label>Datum Od</label>
            <input
              type="date"
              required
              name="datum_od"
              value={raspored.datum_od}
              onChange={handleChange}
            />
          </div>

          <div className="input-wrapper">
            <label>Datum Do</label>
            <input
              required
              type="date"
              name="datum_do"
              value={raspored.datum_do}
              onChange={handleChange}
            />
          </div>

          <button type="submit">sacuvaj</button>
          <div>{error}</div>
        </form>
      </div>
      <div className="pozadina" onClick={props.closeModal}></div>
    </>
  );
}
