import { useEffect, useState } from "react";
import "../IzmeniStudenta.css";
import apiService from "../apiService";

// default vrednosti za novu stavku rasporeda
const novaStavka = {
    raspored_id: 1,
    dan_id: 1,
    vremenski_interval_id: 1,
    predmet_id: 1,
};

export default function DodajStavkuRasporeda(props) {
    const [stavka, setStavka] = useState(novaStavka);
    const [predmeti, setPredmeti] = useState([]);
    const [rasporedi, setRasporedi] = useState([]);
    const [dani, setDani] = useState([]);
    const [vremenskiInterval, setVremenskiInterval] = useState([]);

    function handleChange(event) {
        const { name, value } = event.target;

        setStavka((prevRaspored) => ({
            ...prevRaspored,
            [name]: value,
        }));
    }

    useEffect(() => {
        apiService.getRaspored().then((response) => {
            setRasporedi(response.data.data || []);
        });

        apiService.getDani().then((response) => {
            setDani(response.data.data || []);
        });

        apiService.getVreme().then((response) => {
            setVremenskiInterval(response.data.data || []);
        });

        apiService.getPredmeti().then((response) => {
            setPredmeti(response.data.data || []);
        });
    }, []);

    useEffect(() => {
        // setuje default vrednost za raspored_id
        // jer se moze desiti da je raspored sa id = 1 obrisan
        if (rasporedi.length > 0) {
            setStavka((prevRaspored) => ({
                ...prevRaspored,
                raspored_id: rasporedi[0].ID,
            }));
        }
    }, [rasporedi]);

    return (
        <>
            <div className="modal">
                <form
                    onSubmit={(event) => {
                        event.preventDefault();

                        apiService.createStavku(stavka).then(() => {
                            props.closeModal(true);
                        });
                    }}
                >
                    <div className="input-wrapper">
                        <label>Naziv rasporeda nastave</label>
                        <select
                            name="raspored_id"
                            value={stavka.raspored_id}
                            onChange={handleChange}
                        >
                            {rasporedi.map((raspored) => (
                                <option key={raspored.ID} value={raspored.ID}>
                                    {raspored.NazivRasporeda}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="input-wrapper">
                        <label>Dan</label>
                        <select
                            name="dan_id"
                            value={stavka.dan_id}
                            onChange={handleChange}
                        >
                            {dani.map((dan) => (
                                <option key={dan.DanID} value={dan.DanID}>
                                    {dan.Dan}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="input-wrapper">
                        <label>Vreme</label>
                        <select
                            name="vremenski_interval_id"
                            value={stavka.vremenski_interval_id}
                            onChange={handleChange}
                        >
                            {vremenskiInterval.map((interval) => (
                                <option
                                    key={interval.Vreme}
                                    value={interval.VremeID}
                                >
                                    {interval.Vreme}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="input-wrapper">
                        <label>Predmet</label>
                        <select
                            name="predmet_id"
                            value={stavka.predmet_id}
                            onChange={handleChange}
                        >
                            {predmeti.map((predmet) => (
                                <option
                                    key={predmet.PredmetID}
                                    value={predmet.PredmetID}
                                >
                                    {predmet.Predmet}
                                </option>
                            ))}
                        </select>
                    </div>

                    <button type="submit">Sacuvaj</button>
                </form>
            </div>
            <div className="pozadina" onClick={props.closeModal}></div>
        </>
    );
}
