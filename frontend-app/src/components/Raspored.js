import Navigacija from "./Navigacija";
import { useEffect, useState } from "react";
import apiService from "../apiService";
import DetaljiRasporeda from "./DetaljiRasporeda";
import IzmeniRaspored from "./IzmeniRaspored";

export default function Raspored() {
  const [rasporedi, setRasporedi] = useState([]);
  const [raspored, setRaspored] = useState(null);
  const korisnik = apiService.getLoginInfo();

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

      {korisnik.uloga === "administrator" && (
        <button onClick={() => setRaspored({ naziv_rasporeda: "" })}>
          Dodaj raspored
        </button>
      )}

      {raspored && (
        <IzmeniRaspored
          kreirajNovog={
            korisnik.uloga === "administrator" &&
            raspored.naziv_rasporeda === ""
          }
          raspored={raspored}
          closeModal={(osvezi) => {
            setRaspored(null);

            if (osvezi) {
              osveziRaspored();
            }
          }}
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
            izmeniRaspored={() => {
              console.log(raspored);
              setRaspored(raspored);
            }}
          />
        ))}
      </div>
    </div>
  );
}
