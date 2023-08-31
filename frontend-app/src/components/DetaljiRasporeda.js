import apiService from "../apiService";
import { useState } from "react";

export default function DetaljiRasporeda(props) {
  const [stavke, setStavke] = useState([]);
  const [isOpen, setIsOpen] = useState(false);
  const korisnik = apiService.getLoginInfo();
  const administrator = korisnik.uloga === "administrator";

  function otvoriDetalje() {
    apiService.getStavkeRasporeda(props.ID).then((response) => {
      setStavke(response.data.data || []);
    });
  }

  return (
    <div>
      <div
        className="red raspored"
        key={props.ID}
        onClick={() => {
          setIsOpen(!isOpen);
          otvoriDetalje();
        }}
      >
        <div className="naziv">{props.NazivRasporeda}</div>
        <div className="datum-od">{props.DatumOd}</div>
        <div className="datum-do">{props.DatumDo}</div>

        {administrator ? (
          <div className="akcije">
            <button
              onClick={(event) => {
                event.stopPropagation();
                props.izmeniRaspored();
              }}
            >
              Izmeni
            </button>
            <button
              className="brisanje"
              onClick={(event) => {
                event.stopPropagation();
                props.obrisiRaspored();
              }}
            >
              Obrisi
            </button>
          </div>
        ) : (
          <div></div>
        )}
      </div>

      {isOpen && (
        <div className="stavke">
          {stavke.length === 0 && <div>Nema dodatih stavki</div>}
          {stavke
            .sort((a, b) => a.DanID - b.DanID)
            .map((stavka) => (
              <div className="red-stavke-rasporeda">
                <div className="vreme">{stavka.Dan}</div>
                <div className="vreme">{stavka.Vreme}</div>
                <div>{stavka.Predmet}</div>
              </div>
            ))}
        </div>
      )}
    </div>
  );
}
