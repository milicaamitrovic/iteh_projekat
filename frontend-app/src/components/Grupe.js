import { useEffect, useState } from "react";
import apiService from "../apiService";
import "../Studenti.css";
import Navigacija from "./Navigacija";
import IzmeniGrupu from "./IzmeniGrupu";

export function Grupe() {
  const [grupe, setGrupe] = useState([]);
  const [aktivnaGrupa, setAktivnaGrupa] = useState(null);
  const korisnik = apiService.getLoginInfo();
  const admininstrator = korisnik.uloga === "administrator";

  useEffect(() => {
    apiService.getGrupe().then((response) => {
      setGrupe(response.data.data);
    });
  }, []);

  function osveziGrupe() {
    apiService.getGrupe().then((response) => {
      setGrupe(response.data.data);
    });
  }

  return (
    <div>
      <Navigacija />
      {admininstrator && (
        <button onClick={() => setAktivnaGrupa({ Naziv: "" })}>
          Dodaj grupu
        </button>
      )}

      {aktivnaGrupa && (
        <IzmeniGrupu
          kreirajNovu={admininstrator && aktivnaGrupa.Naziv === ""}
          id={aktivnaGrupa.ID}
          nazivGrupe={aktivnaGrupa.Naziv}
          closeModal={(osvezi) => {
            setAktivnaGrupa(null);

            if (osvezi) {
              osveziGrupe();
            }
          }}
        />
      )}

      <div className="tabela">
        <div className="red header">
          <div className="naziv-grupe title">Ime grupe</div>
          <div></div>
        </div>
        {grupe.map((grupa) => (
          <div className="red" key={grupa.Naziv}>
            <div className="naziv-grupe">{grupa.Naziv}</div>

            <div className="akcije">
              <button
                onClick={() => {
                  setAktivnaGrupa(grupa);
                  console.log(grupa);
                }}
              >
                izmeni
              </button>
              <button className="brisanje">obriši</button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
