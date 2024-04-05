import Login from './pages/login';
import NavBar from './pages/NavBar';
import SideBar from './pages/SideBar';
import Dash from './pages/dash';
import Pharmacie from './pages/Pharmacie';
import './css/styles.css';
import Users from './pages/Users';
import Footer from './pages/Footer';
import Medicaments from './pages/Medicaments';
import {
  createBrowserRouter,
  RouterProvider,
  Outlet
} from "react-router-dom";


function App() {
    const Layout = () => {
      return (
        <div>
        <NavBar/>
    <div id="layoutSidenav">
       <SideBar/>
        <div id="layoutSidenav_content">
            <main>
                <div className="container-fluid px-4">
                <Outlet />
                </div>
            </main>
            <footer className="py-4 bg-light mt-auto">
                <Footer/>
            </footer>
        </div>
    </div> 
    </div>
      )
    }
    const router = createBrowserRouter([
      {
        path: "/dash",
        element: <Layout />,
        children: [
          {
            path: "/dash/pharmacie",
            element: <Pharmacie />
          },
          {
            path: "/dash/users",
            element: <Users />
          },
          {
            path: "/dash/medicaments",
            element: <Medicaments />
          },
          {
            path: "/dash",
            element: <Dash />
          },
        ]
      },
      {
        path:'/',
        element:<Login/>
      }
    ]);
    return (
      <RouterProvider router={router}></RouterProvider>
    )
}

export default App;