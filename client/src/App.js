import Dachbord from './Components/Dashbord/Dachbord';
import './App.css';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Auth from './Components/auth/Auth.jsx';

function App() {
  return (
    <BrowserRouter>
      <div className="App">
        <Routes>
          <Route path="/" element={<Dachbord />} />
          <Route path="/Auth" element={<Auth />} />
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
