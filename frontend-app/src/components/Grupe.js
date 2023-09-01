import { useEffect, useState } from "react";
import apiService from "../apiService";
import "../Studenti.css";
import Navigacija from "./Navigacija";
import IzmeniGrupu from "./IzmeniGrupu";
import PotvrdiBrisanje from "./PotvrdiBrisanje";

export function Grupe() {
    const [grupe, setGrupe] = useState([]);
    const [aktivnaGrupa, setAktivnaGrupa] = useState(null);
    const [grupaId, setGrupaId] = useState(null);
    const [modal, setModal] = useState(null);
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
        <div className="container">
            <Navigacija />
            {admininstrator && (
                <button onClick={() => setAktivnaGrupa({ Naziv: "" })}>
                    Dodaj grupu za nastavu
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

            {modal && (
                <PotvrdiBrisanje
                    potvrdi={() => {
                        apiService.deleteGroup(grupaId).then(() => {
                            osveziGrupe();
                            setModal(false);
                        });
                    }}
                    odustani={() => setModal(false)}
                />
            )}

            <div className="tabela">
                <div className="red header">
                    <div className="naziv-grupe title">
                        Naziv grupe za nastavu
                    </div>
                    <div></div>
                </div>
                {grupe.map((grupa) => (
                    <div className="red" key={grupa.ID}>
                        <div className="naziv-grupe">{grupa.Naziv}</div>

                        <div className="akcije">
                            <button
                                onClick={() => {
                                    setAktivnaGrupa(grupa);
                                }}
                            >
                                Izmeni
                            </button>
                            <button
                                className="brisanje"
                                onClick={() => {
                                    setGrupaId(grupa.ID);
                                    setModal(true);
                                }}
                            >
                                Obrisi
                            </button>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
}
