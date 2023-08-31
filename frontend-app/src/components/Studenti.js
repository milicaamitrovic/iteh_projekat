import { useEffect, useState } from "react";
import apiService from "../apiService";
import "../Studenti.css";
import Navigacija from "./Navigacija";
import IzmeniStudenta from "./IzmeniStudenta";

export function Studenti() {
  const [studenti, setStudenti] = useState([]);
  const [student, setStudent] = useState(null);
  const korisnik = apiService.getLoginInfo();

  useEffect(() => {
    apiService.getUsers().then((response) => {
      setStudenti(response.data.data);
    });
  }, []);

  function osveziStudente() {
    apiService.getUsers().then((response) => {
      setStudenti(response.data.data);
    });
  }

  return (
    <div>
      <Navigacija />
      {korisnik.uloga === "administrator" && (
        <button onClick={() => setStudent({ ime: "" })}>Dodaj studenta</button>
      )}

      {student && (
        <IzmeniStudenta
          kreirajNovog={
            korisnik.uloga === "administrator" && student.ime === ""
          }
          student={student}
          closeModal={(osvezi) => {
            setStudent(null);

            if (osvezi) {
              osveziStudente();
            }
          }}
        />
      )}

      <div className="container tabela">
        <div className="red header">
          <div className="ime">Ime i prezime</div>
          <div className="broj-indeksa">Broj indeksa</div>
          <div className="grupa">Grupa</div>
          <div></div>
        </div>

        {studenti.map((student) => (
          <div className="red" key={student.ID}>
            <div className="ime">{student.Ime + " " + student.Prezime}</div>
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
