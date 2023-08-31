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

            if (props.kreirajNovu) {
              apiService.createGroup({ naziv_grupe: nazivGrupe }).then(() => {
                // kad posaljemo true, osvezicemo tabelu na stranici
                props.closeModal(true);
              });
            } else {
              apiService
                .updateGroup(props.id, { naziv_grupe: nazivGrupe })
                .then(() => {
                  // kad posaljemo true, osvezicemo tabelu na stranici
                  props.closeModal(true);
                });
            }
          }}
        >
          <div className="input-wrapper">
            <label>Naziv grupe</label>
            <input
              required
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
