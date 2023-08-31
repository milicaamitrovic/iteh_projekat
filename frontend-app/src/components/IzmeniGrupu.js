import { useState } from "react";
import "../IzmeniStudenta.css";
import apiService from "../apiService";

export default function IzmeniGrupu(props) {
  const [nazivGrupe, setNazivGrupe] = useState(props.nazivGrupe);

  return (
    <>
      <div className="modal">
        <form
          onSubmit={(event) => {
            event.preventDefault();
            apiService.updateGroup(props.id, { naziv_grupe: nazivGrupe });
          }}
        >
          <div className="input-wrapper">
            <label>Naziv grupe</label>
            <input
              value={nazivGrupe}
              onInput={(event) => setNazivGrupe(event.target.value)}
            />
          </div>
          <button type="submit">sacuvaj</button>
        </form>
      </div>
      <div className="pozadina" onClick={props.closeModal}></div>
    </>
  );
}
