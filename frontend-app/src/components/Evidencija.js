import Navigacija from "./Navigacija";
import apiService from "../apiService";
import { useEffect, useState } from "react";

export default function Evidencija() {
    const [evidencije, setEvidencije] = useState([]);
    const [praznici, setPraznici] = useState([]);
    const [message, setMessage] = useState("");
    const korisnik = apiService.getLoginInfo();
    const administrator = korisnik.uloga === "administrator";

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
                {administrator ? (
                    <div></div>
                ) : (
                    <div className="admin-buttons">
                        <button
                            onClick={() => {
                                apiService
                                    .createEvidenciju()
                                    .then((response) => {
                                        setMessage(response.data);
                                        setPraznici([]);
                                        osveziEvidencije();
                                    });
                            }}
                        >
                            Evidencija prisustva nastavi
                        </button>
                        <button
                            onClick={() => {
                                apiService
                                    .getDrzavniPraznici()
                                    .then((response) => {
                                        setMessage("");
                                        setPraznici(response.data.data || []);
                                    });
                            }}
                        >
                            Nenastavni dani
                        </button>
                    </div>
                )}

                {korisnik.uloga === "administrator" && (
                    <button
                        onClick={() => {
                            window.open(
                                "http://localhost:8000/statistika-prisustva",
                                "_blank"
                            );
                        }}
                    >
                        Statistika evidencije prisustva nastavi
                    </button>
                )}
            </div>

            {message && <div className="poruka">{message}</div>}

            {praznici.length > 0 && (
                <div className="container tabela">
                    <div className="red header">
                        <div className="naziv">Drzavni praznik</div>
                        <div className="datum-od">Datum</div>
                        <div></div>
                    </div>

                    {praznici.map((evidencija) => (
                        <div className="red">
                            <div className="naziv">
                                {evidencija.NazivPraznika}
                            </div>
                            <div className="datum-od">{evidencija.Datum}</div>
                            <div></div>
                        </div>
                    ))}
                </div>
            )}

            {korisnik.uloga === "administrator" && praznici.length === 0 && (
                <div className="container tabela">
                    <div className="red header">
                        <div className="naziv">Student</div>
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
