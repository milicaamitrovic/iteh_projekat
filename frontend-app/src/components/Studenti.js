import { useEffect, useState } from "react";
import apiService from "../apiService";
import "../Studenti.css";
import Navigacija from "./Navigacija";
import IzmeniStudenta from "./IzmeniStudenta";

export function Studenti() {
  const [studenti, setStudenti] = useState([]);
  // trenutno selektovani student
  const [student, setStudent] = useState(null);

  useEffect(() => {
    apiService.getUsers().then((response) => {
      setStudenti(response.data.data);
    });
  }, []);

  return (
    <div>
      <Navigacija />

      {student && (
        <IzmeniStudenta student={student} closeModal={() => setStudent(null)} />
      )}

      <div className="tabela">
        {studenti.map((student) => (
          <div className="red" key={student.ID}>
            <div className="id">{student.ID}</div>
            <div className="ime">{student.Ime}</div>
            <div className="broj-indeksa">{student.BrojIndeksa}</div>
            <div className="grupa">{student.Grupa}</div>
            <div className="akcije">
              <button onClick={() => setStudent(student)}>izmeni</button>
              <button className="brisanje">obriši</button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
