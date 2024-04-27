import React,{useState} from 'react';

export default function AddMedicament() {
    const [name,setName]=useState('');
    const [category,setCategory]=useState('');
    const [general,setGeneral]=useState('');
    const [presentation,setPresentation]=useState('');
    const [Dosage,setDosage]=useState('');
    const [Composition,setComposition]=useState('');
    const [Statut,setStatut]=useState('');
    const [Prix_hospitalier,setPrix_hospitalier]=useState('');
    
    const AjouterMedicament = async (e) => {
      e.preventDefault();
  
      const data = {
          name: name,
          category: category,
          general: general,
          details: {
              presentation: presentation,
              dosage: Dosage,
              composition: Composition,
              statut: Statut,
              "Prix hospitalier": Prix_hospitalier
          }
      };
  
      try {
          const response = await fetch("http://127.0.0.1:8000/api/AjouterMedicament", {
              method: "POST",
              headers: {
                  "Content-Type": "application/json"
              },
              body:data
          });
  
          if (response.ok) {
              console.log("Medicament added successfully");
              // Optionally, you can perform additional actions after successful addition
          } else {
              console.error("Failed to add medicament");
          }
      } catch (error) {
          console.error("Error adding medicament:", error);
      }
  };
  
    return(
      <>
        <form classNameName="container">
          <div className="row mb-4">
            <div className="col">
              <div data-mdb-input-init className="form-outline">
              <label className="form-label" for="Category">Category</label>
                <input type="text" id="Category" className="form-control"  onChange={(e)=>setCategory(e.target.value)}/>
              </div>
            </div>
            <div className="col">
              <div data-mdb-input-init className="form-outline">
              <label className="form-label" for="name">name</label>
                <input type="text" id="name" className="form-control"  onChange={(e)=>setName(e.target.value)}/>
              </div>
            </div>
          </div>

          <div data-mdb-input-init className="form-outline mb-4">
          <label className="form-label" for="general">general</label>
            <input type="text" id="general" className="form-control"  onChange={(e)=>setGeneral(e.target.value)}/>
          </div>
            <h2>Details Medicaments</h2>
          <div data-mdb-input-init className="form-outline mb-4">
          <label className="form-label" for="presentation">presentation</label>
            <input type="text" id="presentation" className="form-control" onChange={(e)=>setPresentation(e.target.value)}/>
          </div>

          <div data-mdb-input-init className="form-outline mb-4">
          <label className="form-label" for="Dosage">Dosage</label>
            <input type="text" id="Dosage" className="form-control"  onChange={(e)=>setDosage(e.target.value)}/>
          </div>

          <div data-mdb-input-init className="form-outline mb-4">
          <label className="form-label" for="Composition">Composition</label>
            <input type="text" id="Composition" className="form-control"  onChange={(e)=>setComposition(e.target.value)}/>
          </div>
          
          <div data-mdb-input-init className="form-outline mb-4">
          <label className="form-label" for="Statut">Statut</label>
            <input type="text" id="Statut" className="form-control"  onChange={(e)=>setStatut(e.target.value)}/>
          </div>

          <div data-mdb-input-init className="form-outline mb-4">
          <label className="form-label" for="Prix">Prix hospitalier</label>
          <input type="number" id="Prix" className="form-control" onChange={(e)=>setPrix_hospitalier(e.target.value)} />
          </div>

        

          <button data-mdb-ripple-init type="button" onClick={AjouterMedicament} className="btn btn-primary btn-block mb-4">Ajouter</button>
        </form>
      </>
    )
}