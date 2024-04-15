import React, { useState, useEffect } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faCheck ,faPlus ,faXmark ,faTrashCan} from '@fortawesome/free-solid-svg-icons';
import axios from 'axios';

function App() {
  const [usersList, setUsersList] = useState([]);
  const [userId, setUserId] = useState(null);
  const [posts, setPosts] = useState([]);
  
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

  useEffect(() => {
    fetchUsersData();
  }, []);

  const Afficher = (userId) => {
    const selectedUser = usersList.filter(user => user.id === userId);
    if (selectedUser) {
      setPosts(selectedUser);
      setUserId(userId);
    } else {
      console.error('Utilisateur non trouvé');
    }
  };

  const Delete = (userId) =>{
    axios.delete(`http://127.0.0.1:8000/api/delete/${userId}`)
  .then(response => {
    console.log('Delete request successful:', response);
    fetchUsersData()
  })
  .catch(error => {
    console.error('Error making delete request:', error);
  });
  }

  const ValideUsers = (emailUsers) =>{
    axios.get(`http://127.0.0.1:8000/api/sendEMail/${emailUsers}`)
    .then(response => {
      
      console.log('email send successful:', response);
      //fetchUsersData()
    })
    .catch(error => {
      console.error('Error making sending email request:', error);
    });
  }

  const Fermer = () => {
    setUserId(null);
    setPosts([]);
  };

  return (
    <div className="container mt-5">
      <ul className="list-group">
        {usersList.map((user) => (
          <li key={user.id} className="list-group-item">
            <div className="d-flex justify-content-between align-items-center">
              <div>
                <span>Nom : {user.nom}</span>
              </div>
              <div>
              <button  onClick={() => Afficher(user.id)}>
                <FontAwesomeIcon icon={faPlus} className='bg-blue-700 text-white px-4 py-2 rounded mx-2' />
              </button>
              <button  onClick={() => ValideUsers(user.email)}>
                <FontAwesomeIcon icon={faCheck} className='bg-green-700 text-white px-4 py-2 rounded mx-2' />
              </button>
              <button  onClick={() => Delete(user.id)}>
                <FontAwesomeIcon icon={faTrashCan} className='bg-red-700 text-white px-4 py-2 rounded mx-2' />
              </button>
              </div>
            </div>
            {userId === user.id && (
              <div className="mt-3">
                <ul className="list-group">
                  {posts.map((post) => (
                    <li key={post.id} className="list-group-item">
                      <strong>{post.prenom}</strong>
                      <p>{post.email }</p>
                      <p>{post.ville }</p>
                      <p>{post.numtel }</p>
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
    </div>
  );
}

export default App;
