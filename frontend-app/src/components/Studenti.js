import { useEffect, useState } from "react";
import apiService from "../apiService";
import "../Studenti.css";
import Navigacija from "./Navigacija";
import IzmeniStudenta from "./IzmeniStudenta";
import PotvrdiBrisanje from "./PotvrdiBrisanje";

export function Studenti() {
  const [studenti, setStudenti] = useState([]);
  const [student, setStudent] = useState(null);
  const [studentId, setStudentId] = useState(null);
  const [brojIndexa, setBrojIndexa] = useState("");
  const [modal, setModal] = useState(null);
  const korisnik = apiService.getLoginInfo();
  const [isChecked, setIsChecked] = useState(false);

  useEffect(() => {
    apiService.getUsers().then((response) => {
      setStudenti(response.data.data || []);
    });
  }, []);

  function osveziStudente() {
    apiService.getUsers().then((response) => {
      setStudenti(response.data.data);
    });
  }

  function sortiraj(event) {
    setIsChecked(event.target.checked);

    if (event.target.checked) {
      setStudenti([...studenti].sort((a, b) => a.Ime.localeCompare(b.Ime)));
    } else {
      osveziStudente();
    }
  }

  const fliltriraniStudenti = studenti.filter((student) =>
    student.BrojIndeksa.includes(brojIndexa)
  );

  return (
    <div className="container">
      <Navigacija />
      <div className="sort-by-name">
        <div>
          {korisnik.uloga === "administrator" && (
            <button onClick={() => setStudent({ ime: "" })}>
              Dodaj studenta
            </button>
          )}
        </div>

        <div>
          <input
            type="search"
            placeholder="Pretrazi po broju indexa"
            onInput={(event) => setBrojIndexa(event.target.value)}
          />
        </div>

        <label>
          <input type="checkbox" checked={isChecked} onChange={sortiraj} />
          <span>Sortiraj po imenu</span>
        </label>
      </div>

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

      {modal && (
        <PotvrdiBrisanje
          potvrdi={() => {
            apiService.deleteUser(studentId).then(() => {
              osveziStudente();
              setModal(false);
            });
          }}
          odustani={() => setModal(false)}
        />
      )}

      <div className="container tabela">
        <div className="red header">
          <div className="ime">Ime i prezime</div>
          <div className="broj-indeksa">Broj indeksa</div>
          <div className="grupa">Grupa</div>
          <div></div>
        </div>

        {fliltriraniStudenti.map((student) => (
          <div className="red" key={student.ID}>
            <div className="ime">{student.Ime + " " + student.Prezime}</div>
            <div className="broj-indeksa">{student.BrojIndeksa}</div>
            <div className="grupa">{student.Grupa}</div>
            <div className="akcije">
              <button onClick={() => setStudent(student)}>izmeni</button>
              <button
                className="brisanje"
                onClick={() => {
                  setStudentId(student.ID);
                  setModal(true);
                }}
              >
                Obriši
              </button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
