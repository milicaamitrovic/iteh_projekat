import Navigacija from "./Navigacija";
import { useEffect, useState } from "react";
import apiService from "../apiService";
import DetaljiRasporeda from "./DetaljiRasporeda";
import IzmeniRaspored from "./IzmeniRaspored";
import DodajStavkuRasporeda from "./DodajStavkuRasporeda";
import PotvrdiBrisanje from "./PotvrdiBrisanje";

export default function Raspored() {
  const [rasporedi, setRasporedi] = useState([]);
  const [raspored, setRaspored] = useState(null);
  const [rasporedId, setRasporedId] = useState(null);
  const [stavka, setStavka] = useState(false);
  const [modal, setModal] = useState(null);

  const korisnik = apiService.getLoginInfo();
  const administrator = korisnik.uloga === "administrator";

  useEffect(() => {
    apiService.getRaspored().then((response) => {
      setRasporedi(response.data.data);
    });
  }, []);

  function osveziRaspored() {
    apiService.getRaspored().then((response) => {
      setRasporedi(response.data.data);
    });
  }

  return (
    <div className="container">
      <Navigacija />

      <div className="admin-buttons">
        {administrator && (
          <button onClick={() => setRaspored({ naziv_rasporeda: "" })}>
            Dodaj raspored
          </button>
        )}

        {administrator && (
          <button onClick={() => setStavka(true)}>
            Dodaj stavku rasporeda
          </button>
        )}
      </div>

      {raspored && (
        <IzmeniRaspored
          kreirajNovog={administrator && raspored.naziv_rasporeda === ""}
          raspored={raspored}
          closeModal={(osvezi) => {
            setRaspored(null);

            if (osvezi) {
              osveziRaspored();
            }
          }}
        />
      )}

      {stavka && (
        <DodajStavkuRasporeda
          closeModal={(osvezi) => {
            setStavka(null);

            if (osvezi) {
              osveziRaspored();
            }
          }}
        />
      )}

      {modal && (
        <PotvrdiBrisanje
          potvrdi={() => {
            apiService.deleteRaspored(rasporedId).then(() => {
              osveziRaspored();
              setModal(false);
            });
          }}
          odustani={() => setModal(false)}
        />
      )}

      <div className="container tabela">
        <div className="red header">
          <div className="naziv">Naziv rasporeda</div>
          <div className="datum-od">Od</div>
          <div className="datum-do">Do</div>
          <div></div>
        </div>

        {rasporedi.map((raspored) => (
          <DetaljiRasporeda
            {...raspored}
            key={raspored.ID}
            izmeniRaspored={() => {
              setRaspored(raspored);
            }}
            obrisiRaspored={() => {
              setRasporedId(raspored.ID);
              setModal(true);
            }}
          />
        ))}
      </div>
    </div>
  );
}
