import React from 'react';
import { Link } from "react-router-dom"; 
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'bootstrap/dist/css/bootstrap.min.css';


const NavBar = () => {
  const logOut =()=>{
    
  }
    return (
        <nav className="sb-topnav navbar navbar-expand bg-slate-200  border rounded ">
        
        <Link className="navbar-brand ps-3" to="#">PharmEasy</Link>
        
        <button className="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" ><i className="fas fa-bars"></i></button>
       
        <form className="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            
        </form>
        
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li className="nav-item dropdown">
  <button className="nav-link dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Click</button>
  <ul className="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    <li><button className="dropdown-item" onClick={logOut}>Logout</button></li>
  </ul>
</li>

  </ul>
    </nav>
    );
}

export default NavBar;
