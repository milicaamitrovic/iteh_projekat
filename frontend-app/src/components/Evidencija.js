import Navigacija from "./Navigacija";
import apiService from "../apiService";
import { useEffect, useState } from "react";

export default function Evidencija() {
  const [evidencije, setEvidencije] = useState([]);
  const [praznici, setPraznici] = useState([]);
  const [message, setMessage] = useState("");
  const korisnik = apiService.getLoginInfo();

  function osveziEvidencije() {
    apiService.getEvidencije().then((response) => {
      setEvidencije(response.data.data || []);
    });
  }

  useEffect(() => {
    osveziEvidencije();
  }, []);

  return (
    <div className="container">
      <Navigacija />

      <div className="admin-buttons">
        <button
          onClick={() => {
            apiService.createEvidenciju().then((response) => {
              setMessage(response.data);
              setPraznici([]);
              osveziEvidencije();
            });
          }}
        >
          Potvrdi evidenciju
        </button>

        <button
          onClick={() => {
            apiService.getDrzavniPraznici().then((response) => {
              setMessage("");
              setPraznici(response.data.data || []);
            });
          }}
        >
          Drzavni praznici
        </button>

        {korisnik.uloga === "administrator" && (
          <button
            onClick={() => {
              window.open(
                "http://localhost:8000/statistika-prisustva",
                "_blank"
              );
            }}
          >
            Statistika prisustva
          </button>
        )}
      </div>

      {message && <div className="poruka">{message}</div>}

      {praznici.length > 0 && (
        <div className="container tabela">
          <div className="red header">
            <div className="naziv">Praznik</div>
            <div className="datum-od">Datum</div>
            <div></div>
          </div>

          {praznici.map((evidencija) => (
            <div className="red">
              <div className="naziv">{evidencija.NazivPraznika}</div>
              <div className="datum-od">{evidencija.Datum}</div>
              <div></div>
            </div>
          ))}
        </div>
      )}

      {korisnik.uloga === "administrator" && praznici.length === 0 && (
        <div className="container tabela">
          <div className="red header">
            <div className="naziv">Korisnik</div>
            <div className="datum-od">Datum</div>
            <div></div>
          </div>

          {evidencije.map((evidencija) => (
            <div className="red">
              <div className="naziv">{evidencija.Korisnik}</div>
              <div className="datum-od">{evidencija.Datum}</div>
              <div></div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}
