import React, { useState, useEffect } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faCheck, faPlus, faXmark, faTrashAlt } from '@fortawesome/free-solid-svg-icons';
import axios from 'axios';

const Pharmacie = () => {
    const [pharmacieList, setPharmacieList] = useState([]);
    const [pharmacieId, setPharmacieId] = useState(null);
    const [posts, setPosts] = useState([]);
    const [pharmacieConfirmer, setPharmacieConfirmer] = useState([]);
    const [pharmacieNonConfirmer, setPharmacieNonConfirmer] = useState([]);
    //const [check, setCheck ]= useState(false);
    const [pharmaciesSelectionnees, setPharmaciesSelectionnees] = useState([]);


    const fetchPharmaciesData = async () => {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/pharmacie');
            if (response.data.status === 200) {
                setPharmacieList(response.data.pharmacie);
                setPharmacieConfirmer(response.data.pharmacie.filter(n => n.confirmer === 1));
                setPharmacieNonConfirmer(response.data.pharmacie.filter(n => n.confirmer === 0));
                
            } else {
                console.log('Error:', response.data.message);
            }
        } catch (error) {
            console.error('FetchError:', error);
        }
    };

    useEffect(() => {
        fetchPharmaciesData();
    }, []);

    const Afficher = (pharmacieId) => {
        const selectedUser = pharmacieList.find(user => user.id === pharmacieId);
        if (selectedUser) {
            setPosts([selectedUser]);
            setPharmacieId(pharmacieId);
        } else {
            console.error('Utilisateur non trouvé');
        }
    };

    const Delete = (pharmacieId) => {
        axios.delete(`http://127.0.0.1:8000/api/deletePharmacie/${pharmacieId}`)
            .then(response => {
                console.log('Delete request successful:', response);
                fetchPharmaciesData();
            })
            .catch(error => {
                console.error('Error making delete request:', error);
            });
    };

    const ValideUsers = (emailUsers) => {
        axios.get(`http://127.0.0.1:8000/api/sendEMail/${emailUsers}`)
            .then(response => {
                console.log('email send successful:', response);
                fetchPharmaciesData();
            })
            .catch(error => {
                console.error('Error making sending email request:', error);
            });
    };

    const Fermer = () => {
        setPharmacieId(null);
        setPosts([]);
    };
    const ValiderPharmaciesSelectionnees = () => {
        axios.put('http://127.0.0.1:8000/api/validerPharmacies', { pharmaciesSelectionnees ,action:'confirm'})
            .then(response => {
                console.log('Mise à jour réussie:', response);
                // Rafraîchir les données après la mise à jour
                fetchPharmaciesData();
            })
            .catch(error => {
                console.error('Erreur lors de la mise à jour:', error);
            });
    };
    
    const handleCheckboxChange = (pharmacieId) => {
        // Vérifier si la pharmacie est déjà sélectionnée
        const index = pharmaciesSelectionnees.indexOf(pharmacieId);
        if (index === -1) {
            // Ajouter la pharmacie à la liste des pharmacies sélectionnées
            setPharmaciesSelectionnees([...pharmaciesSelectionnees, pharmacieId]);
        } else {
            // Retirer la pharmacie de la liste des pharmacies sélectionnées
            const newSelection = pharmaciesSelectionnees.filter((id) => id !== pharmacieId);
            setPharmaciesSelectionnees(newSelection);
        }
    };

    const UnvalidePharmaciesSelectionnees = () => {
        axios.put('http://127.0.0.1:8000/api/validerPharmacies', { pharmaciesSelectionnees, action: 'unconfirm' })
            .then(response => {
                console.log('Mise à jour réussie:', response);
                // Rafraîchir les données après la mise à jour
                fetchPharmaciesData();
            })
            .catch(error => {
                console.error('Erreur lors de la mise à jour:', error);
            });
    };
    const DeleteAllPharmacies = () => {
     
            axios.delete('http://127.0.0.1:8000/api/deleteAllPharmacies', { data: { pharmaciesSelectionnees } })
        .then(response => {
            console.log('Pharmacies deleted successfully:', response);
            // Refresh the data after deletion
            fetchPharmaciesData();
        })
        .catch(error => {
            console.error('Error deleting pharmacies:', error);
        });
    };
    

    return (
        <div className="container mt-5">
                        <h3>pharmacie No Confirmer </h3>

            <ul className="list-group">
                {pharmacieNonConfirmer.map((user) => (
                    <li key={user.id} className="list-group-item">
                        <div className="d-flex justify-content-between align-items-center">
                        <input type='checkbox' name='Noconfirmer'  checked={pharmaciesSelectionnees.includes(user.id)} 
                            onChange={() => handleCheckboxChange(user.id)} />
                            <div>
                                <span>Nom : {user.NomPhar}</span>
                            </div>
                            <div>
                                <button onClick={() => Afficher(user.id)}>
                                    <FontAwesomeIcon icon={faPlus} className='bg-blue-700 text-white px-4 py-2 rounded mx-2' />
                                </button>
                                <button onClick={() => ValideUsers(user.email)}>
                                    <FontAwesomeIcon icon={faCheck} className='bg-green-700 text-white px-4 py-2 rounded mx-2' />
                                </button>
                                <button onClick={() => Delete(user.id)}>
                                    <FontAwesomeIcon icon={faTrashAlt} className='bg-red-700 text-white px-4 py-2 rounded mx-2' />
                                </button>
                            </div>
                        </div>
                        {pharmacieId === user.id && (
                            <div className="mt-3">
                                <ul className="list-group">
                                    {posts.map((post) => (
                                        <li key={post.id} className="list-group-item">
                                            <strong>{post.villePh}</strong>
                                            <p>{post.email}</p>
                                            <p>{post.Adresse}</p>
                                            <p>{post.NumTele}</p>
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
            <h3>pharmacie Confirmer </h3>
            <ul className="list-group">
                {pharmacieConfirmer.map((user) => (
                    <li key={user.id} className="list-group-item">
                        <div className="d-flex justify-content-between align-items-center">
                        <input type='checkbox' name='confirmer'  checked={pharmaciesSelectionnees.includes(user.id)} 
                            onChange={() => handleCheckboxChange(user.id)} />
                            <div>
                                <span>Nom : {user.NomPhar}</span>
                            </div>
                            <div>
                                <button onClick={() => Afficher(user.id)}>
                                    <FontAwesomeIcon icon={faPlus} className='bg-blue-700 text-white px-4 py-2 rounded mx-2' />
                                </button>

                                <button onClick={() => Delete(user.id)}>
                                    <FontAwesomeIcon icon={faTrashAlt} className='bg-red-700 text-white px-4 py-2 rounded mx-2' />
                                </button>

                               
                            </div>
                        </div>
                        {pharmacieId === user.id && (
                            <div className="mt-3">
                                <ul className="list-group">
                                    {posts.map((post) => (
                                        <li key={post.id} className="list-group-item">
                                            <strong>{post.villePh}</strong>
                                            <p>{post.email}</p>
                                            <p>{post.Adresse}</p>
                                            <p>{post.NumTele}</p>
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
            <button className="btn btn-primary px-2" onClick={ValiderPharmaciesSelectionnees}>
    Valider les pharmacies 
</button>

      <button className="btn btn-secondary px-2" onClick={UnvalidePharmaciesSelectionnees}>
                Invalider les pharmacies
                                </button>
                                <button className="btn btn-danger px-2" onClick={DeleteAllPharmacies}>
                                    Supprimer les pharmacies
                                </button>
        </div>
    );
};

export default Pharmacie;
