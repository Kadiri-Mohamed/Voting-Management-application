import Dachbord from './Components/Dashbord/Dachbord';
import './App.css';

import VotePage from './Components/Vote/VotePage';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Header from './Components/Dashbord/Header';
import Home from './Components/Dashbord/Home';

function App() {
  return (
    <BrowserRouter>
      <div className="App">
        <Routes>
          <Route path="/dashboard" element={<Dachbord />} />
          <Route path="/vote/:voteId" element={<VotePage />} />
          <Route path='/' element={<Home />} />
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
