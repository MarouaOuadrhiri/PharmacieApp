import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faUserDoctor, faAngleRight, faUsers, faCapsules } from '@fortawesome/free-solid-svg-icons';

const Card = () => {
    const [usersList, setUsersList] = useState([]);
    const [medicamentsList, setMedicamentsList] = useState([]);
    const [pharmacieList, setPharmacieList] = useState([]);

    useEffect(() => {
        const fetchUsersData = async () => {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/index');
                const data = await response.json();
                if (data.status === 200) {
                    setUsersList(data.utilisateur);
                } else {
                    console.log('Error:', data.message);
                }
            } catch (error) {
                console.error('FetchError:', error);
            }
        };

        fetchUsersData();
    }, []);

    useEffect(() => {
        const fetchMedicamentsData = async () => {
            const response = await fetch('http://127.0.0.1:8000/api/getAll');
            const data = await response.json();
            setMedicamentsList(data);
        };

        fetchMedicamentsData();
    }, []);
    useEffect(() => {
            const fetchPharmaciesData = async () => {
                const response = await fetch('http://127.0.0.1:8000/api/pharmacie');
                const data = await response.json();
                setPharmacieList(data.pharmacie);
            };

            fetchPharmaciesData();
        }, []);

    return (
        <>
            <div className="row">
                <div className="col-xl-4 col-md-6">
                    <div className="card mb-4 border-2 border-slate-300 hover:shadow-2xl">
                        <Link className="text-decoration-none card-link text-slate-950 hover:text-blue-700 focus:outline-none focus:text-blue-700" to="/dash/users">
                            <div className="card-body my-3 mx-4">
                                <span><FontAwesomeIcon icon={faUsers} className="ml-3 mr-4" /> Users {usersList.length}</span>
                            </div>
                            <div className="card-footer d-flex align-items-center justify-content-between">
                                <div className="small mx-2 my-2"><FontAwesomeIcon icon={faAngleRight} className="mx-3" /> View Details</div>
                            </div>
                        </Link>
                    </div>
                </div>

                <div className="col-xl-4 col-md-6">
                    <div className="card mb-4 border-2 border-slate-300 hover:shadow-2xl">
                        <Link className="text-decoration-none card-link text-slate-950 hover:text-blue-700 focus:outline-none focus:text-blue-700" to="/dash/pharmacie">
                            <div className="card-body my-3 mx-4">
                                <span><FontAwesomeIcon icon={faUserDoctor} className="ml-3 mr-4" /> Pharmacie {pharmacieList.length}</span>
                            </div>
                            <div className="card-footer d-flex align-items-center justify-content-between">
                                <div className="small mx-2 my-2"><FontAwesomeIcon icon={faAngleRight} className="mx-3" /> View Details</div>
                            </div>
                        </Link>
                    </div>
                </div>

                <div className="col-xl-4 col-md-6">
                    <div className="card mb-3 border-2 border-slate-300 hover:shadow-2xl">
                        <Link className="text-decoration-none card-link text-slate-950 hover:text-blue-700 focus:outline-none focus:text-blue-700" to="/dash/medicaments">
                            <div className="card-body my-3 mx-4">
                                <span><FontAwesomeIcon icon={faCapsules} className="ml-3 mr-4" /> Medicaments {medicamentsList.length}</span>
                            </div>
                            <div className="card-footer d-flex align-items-center justify-content-between">
                                <div className="small mx-2 my-2"><FontAwesomeIcon icon={faAngleRight} className="mx-3" /> View Details</div>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Card;
