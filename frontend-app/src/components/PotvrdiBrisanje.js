export default function PotvrdiBrisanje(props) {
    return (
        <div className="pozadina" onClick={() => props.odustani()}>
            <div className="modal-za-potvrdu">
                <h3>
                    Ukoliko kliknes Obrisi, ova stavka ce biti trajno obrisana.
                </h3>
                <div className="dugmici">
                    <button
                        className="brisanje"
                        onClick={() => props.potvrdi()}
                    >
                        Obrisi
                    </button>
                </div>
            </div>
        </div>
    );
}
