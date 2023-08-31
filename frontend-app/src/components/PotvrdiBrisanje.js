export default function PotvrdiBrisanje(props) {
  return (
    <div className="pozadina" onClick={() => props.odustani()}>
      <div className="modal-za-potvrdu">
        <h3>Da li ste sigurni da zelite da obrišete</h3>
        <div className="dugmici">
          <button className="brisanje" onClick={() => props.potvrdi()}>
            Obriši
          </button>
        </div>
      </div>
    </div>
  );
}
