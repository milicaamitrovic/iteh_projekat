import { useEffect, useState } from "react";
import "../IzmeniStudenta.css";
import apiService from "../apiService";

export default function IzmeniStudenta(props) {
  const [error, setError] = useState("");
  const [grupe, setGrupe] = useState([]);
  const [student, setStudent] = useState({
    ime: props.student.Ime,
    prezime: props.student.Prezime,
    broj_indeksa: props.student.BrojIndeksa,
    email: props.student.Email,
    grupa_za_nastavu_id: props.student.GrupaID,
    administrator: props.student.Grupa === "admin",
    password: "",
  });

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
            apiService.updateUser(props.student.ID, student).then(() => {
              // kad posaljemo true, osvezicemo tabelu na stranici
              props.closeModal(true);
            });
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
