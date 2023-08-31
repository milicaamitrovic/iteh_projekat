import { useEffect, useState } from "react";
import apiService from "../apiService";
import "../Studenti.css";
import Navigacija from "./Navigacija";
import IzmeniGrupu from "./IzmeniGrupu";

export function Grupe() {
  const [grupe, setGrupe] = useState([]);
  const [aktivnaGrupa, setAktivnaGrupa] = useState(null);

  useEffect(() => {
    apiService.getGrupe().then((response) => {
      setGrupe(response.data.data);
    });
  }, []);

  return (
    <div>
      <Navigacija />

      {aktivnaGrupa && (
        <IzmeniGrupu
          id={aktivnaGrupa.ID}
          nazivGrupe={aktivnaGrupa.Naziv}
          closeModal={() => setAktivnaGrupa(null)}
        />
      )}

      <div className="tabela">
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
