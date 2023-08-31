import { useEffect, useState } from "react";
import "../IzmeniStudenta.css";
import apiService from "../apiService";

const noviKorisnik = {
  ime: "",
  prezime: "",
  broj_indeksa: "",
  email: "",
  grupa_za_nastavu_id: 1, // admin je default grupa
  administrator: false,
  password: "",
};

export default function IzmeniStudenta(props) {
  const [error, setError] = useState("");
  const [grupe, setGrupe] = useState([]);

  const editKorisnika = {
    ime: props.student.Ime,
    prezime: props.student.Prezime,
    broj_indeksa: props.student.BrojIndeksa,
    email: props.student.Email,
    grupa_za_nastavu_id: props.student.GrupaId,
    administrator: props.student.Grupa === "admin",
    password: "",
  };

  const [student, setStudent] = useState(
    props.kreirajNovog ? noviKorisnik : editKorisnika
  );

  function handleChange(event) {
    const { name, value } = event.target;

    setStudent((prevStudent) => ({
      ...prevStudent,
      [name]: value,
    }));
  }

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
              apiService.createUser(student).then(() => {
                props.closeModal(true);
              });
            } else {
              apiService.updateUser(props.student.ID, student).then(() => {
                props.closeModal(true);
              });
            }
          }}
        >
          <div className="input-wrapper">
            <label>Ime</label>
            <input
              required
              name="ime"
              value={student.ime}
              onChange={handleChange}
            />
          </div>

          <div className="input-wrapper">
            <label>Prezime</label>
            <input
              required
              name="prezime"
              value={student.prezime}
              onChange={handleChange}
            />
          </div>

          <div className="input-wrapper">
            <label>Broj indeksa</label>
            <input
              required
              maxLength="9"
              name="broj_indeksa"
              value={student.broj_indeksa}
              onChange={handleChange}
            />
          </div>

          <div className="input-wrapper">
            <label>Grupa</label>
            <select
              name="grupa_za_nastavu_id"
              value={student.grupa_za_nastavu_id}
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
            <label>Email</label>
            <input
              required
              name="email"
              type="email"
              value={student.email}
              onChange={handleChange}
            />
          </div>

          <div className="input-wrapper">
            <label>Password</label>
            <input
              required
              name="password"
              value={student.password}
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
