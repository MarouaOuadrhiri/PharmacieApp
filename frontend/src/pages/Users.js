import React, { useState, useEffect } from 'react';

function App() {
  const [usersList, setUsersList] = useState([]);
  const [userId, setUserId] = useState(null);
  const [posts, setPosts] = useState([]);

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

  const Afficher = (userId) => {
    const selectedUser = usersList.filter(user => user.id === userId);
    if (selectedUser) {
      setPosts(selectedUser);
      setUserId(userId);
    } else {
      console.error('Utilisateur non trouvé');
    }
  };

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
                <span>Nom : {user.name}</span><br/>
                <span>Email : {user.email}</span><br/>
              </div>
              <button className="btn btn-primary" onClick={() => Afficher(user.id)}>
                Détails des posts
              </button>
            </div>
            {userId === user.id && (
              <div className="mt-3">
                <ul className="list-group">
                  {posts.map((post) => (
                    <li key={post.id} className="list-group-item">
                      <strong>{post.nom}</strong>
                      <p>{post.prenom }</p>
                    </li>
                  ))}
                </ul>
                <button className="btn btn-secondary mt-3" onClick={Fermer}>
                  Fermer les détails
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
