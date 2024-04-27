import React,{useState,useEffect} from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faPlus ,faXmark ,faSearch} from '@fortawesome/free-solid-svg-icons';
import {Link} from "react-router-dom";


const Medicaments = () => {
    const [medicamentsList, setMedicamentsList] = useState([]);
    const [pharmacieId, setpharmacieId] = useState(null);
    const [posts, setPosts] = useState([]);
    const [medicament,setMedicament]=useState();
    
    const fetchMedicamentsData = async () => {
        const response = await fetch('http://127.0.0.1:8000/api/getAll');
        const data = await response.json();
        setMedicamentsList(data);
    };
  
  
    useEffect(() => {
        fetchMedicamentsData();
    }, []);
  
    const Afficher = (pharmacieId) => {
      const selectedUser = medicamentsList.filter(user => user.id === pharmacieId);
      if (selectedUser) {
        setPosts(selectedUser);
        setpharmacieId(pharmacieId);
      } else {
        console.error('Utilisateur non trouvé');
      }
    };
  
    const rechercher = () => {
      if (medicament.trim() === '') {
        // Si la recherche est vide, réinitialiser la liste des médicaments avec toutes les données
        fetchMedicamentsData();
        //setMedicamentsList(medicamentsList); // Remplacer allMedicaments par votre liste complète de médicaments
      } else {
        // Sinon, filtrer la liste selon la recherche
        setMedicamentsList(
          medicamentsList.filter((m) =>
            m.name.toLowerCase().startsWith(medicament.toLowerCase())
          )
        );
      }
    };
   
  
    const Fermer = () => {
      setpharmacieId(null);
      setPosts([]);
    };
    return (
        <div className="container mt-5">
             <form className="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div className="input-group">
                <input className="form-control" onChange={(e)=>setMedicament(e.target.value)} type="text"  placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button className="btn btn-primary" onClick={rechercher}  id="btnNavbarSearch" type="button">{/*<i className="fas fa-search"></i>*/}<FontAwesomeIcon icon={faSearch} /></button>
            </div>
            <div className="input-group">
                <button className="btn btn-primary text text-dark"   id="btnNavbarSearch" type="button">
                <Link to="/dash/ajouterMedicament">Ajouter</Link> 
                  </button>
            </div>
        </form>
      <ul className="list-group">
       
        {medicamentsList.map((user) => (
          <li key={user.id} className="list-group-item">
            <div className="d-flex justify-content-between align-items-center">
              <div>
                <span>Nom : {user.name}</span>
              </div>
              <div>
              <button  onClick={() => Afficher(user.id)}>
                <FontAwesomeIcon icon={faPlus} className='bg-blue-700 text-white px-4 py-2 rounded mx-2' />
              </button>
              </div>
            </div>
            {pharmacieId === user.id && (
              <div className="mt-3">
                <ul className="list-group">
                  {posts.map((post) => (
                    <li key={post.id} className="list-group-item">
                      <strong>{post.category}</strong>
                      <p>{post.general }</p>
                      <p>{post.details.presentation }</p>
                      <p>{post.details.Indication}</p>
                    </li>
                  ))}
                </ul>
                <button className="" onClick={Fermer}>
                  <FontAwesomeIcon icon={faXmark} className='bg-green-700 text-white px-4 py-2 rounded' />
                </button>
              </div>
            )}
          </li>
        ))}
      </ul>
    </div>)
}

export default Medicaments;
