import { useState } from "react";
import "../IzmeniStudenta.css";

export default function IzmeniStudenta(props) {
  const [student, setStudent] = useState({
    ID: props.student.ID,
    Ime: props.student.Ime,
    BrojIndeksa: props.student.BrojIndeksa,
    Grupa: props.student.Grupa,
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setStudent((prevStudent) => ({
      ...prevStudent,
      [name]: value,
    }));
  };

  return (
    <>
      <div className="modal">
        <form>
          <div className="input-wrapper">
            <label>ID</label>
            <input name="ID" value={student.ID} onChange={handleChange} />
          </div>
          <div className="input-wrapper">
            <label>Ime</label>
            <input name="Ime" value={student.Ime} onChange={handleChange} />
          </div>
          <div className="input-wrapper">
            <label>Broj indeksa</label>
            <input
              name="BrojIndeksa"
              value={student.BrojIndeksa}
              onChange={handleChange}
            />
          </div>
          <div className="input-wrapper">
            <label>Grupa</label>
            <input name="Grupa" value={student.Grupa} onChange={handleChange} />
          </div>
        </form>
      </div>
      <div className="pozadina" onClick={props.closeModal}></div>
    </>
  );
}
