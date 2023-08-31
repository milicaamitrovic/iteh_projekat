import Navigacija from "./Navigacija";
import apiService from "../apiService";
import { useEffect, useState } from "react";

export default function Evidencija() {
  const [evidencije, setEvidencije] = useState([]);
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
      <button
        onClick={() => {
          apiService.createEvidenciju().then((response) => {
            setMessage(response.data);
            osveziEvidencije();
          });
        }}
      >
        Potvrdi evidenciju
      </button>
      <Navigacija />

      {message && <div className="poruka">{message}</div>}

      {korisnik.uloga === "administrator" && (
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
