import { Link } from "react-router-dom";
import '../css/styles.css';
import { useState,useEffect } from "react";
import axios from 'axios';

export default function Login(){
    const[emailu,setEmailU]=useState('');
    const[passwordu,setPassword]=useState('');

    const handleSubmit = (e) => {
      e.preventDefault();
      const data = {
        email: emailu,
        password: passwordu
      };
      console.log(data);

      fetch("http://127.0.0.1:8000/api/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
      })
      .then(response => {
        // Check if the request was successful
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        // Parse the JSON from the response
        return response.json();
      })
      .then(data => {
        // Log the data received from thez server
        console.log(data);
        localStorage.setItem('userData', JSON.stringify(data));

        // Redirect to another page after successful login
        window.location.href = "/dash"; // Change "/another-page" to the URL of the page you want to redirect to
      })
      .catch(error => {
        // Log any errors that occurred during the fetch
        console.error('There was a problem with the fetch operation:', error);
      });
    }
      
        /* axios.post('http://127.0.0.1:8000/api/login', data)
    .then(res => {
      if (res.data.status === 200) {
        localStorage.setItem('auth_token', res.data.token);
        localStorage.setItem('auth_name', res.data.username);
        console.log('success');
        //history.push('/');
        //swal('sucess',res.data.message);
      } else if (res.data.status === 401) {
        console.log('invalid password');
      } else {
        console.log('error', res.data); // Log the response data for debugging
      }
    })
    .catch(error => {
      console.error('AxiosError:', error);
    }); */
  

    return(
        <div id="layoutAuthentication">
            <nav>
            <Link to="/dash">dashbord</Link>
            </nav>
            <div id="layoutAuthentication_content">
                <main>
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-lg-5">
                                <div className="card shadow-lg border-0 rounded-lg mt-5">
                                    <div className="card-header">
                                        <h3 className="text-center font-weight-light my-4">Login</h3>
                                    </div>
                                    <div className="card-body">
                                        <form onSubmit={handleSubmit} method='post'>
                                            <div className="form-floating mb-3">
                                                <input className="form-control" id="inputEmail" type="email" placeholder="name@example.com" onChange={(e) => setEmailU(e.target.value)} />
                                                <label htmlFor="inputEmail">Email address</label>
                                            </div>
                                            <div className="form-floating mb-3">
                                                <input className="form-control" id="inputPassword" type="password" placeholder="Password" onChange={(e) => setPassword(e.target.value)} />
                                                <label htmlFor="inputPassword">Password</label>
                                            </div>
                                            <div className="form-check mb-3">
                                                <input className="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label className="form-check-label" htmlFor="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div className="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a className="small" href="password.html">Forgot Password?</a>
                                                <button className="btn btn-primary" type='submit'>Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    {/* <div className="card-footer text-center py-3">
                                        <div className="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div> */}
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer className="py-4 bg-light mt-auto">
                    <div className="container-fluid px-4">
                        <div className="d-flex align-items-center justify-content-between small">
                            <div className="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <div>
                                    hey
                                </div>
                                <Link to="#">Privacy Policy</Link>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    )
}