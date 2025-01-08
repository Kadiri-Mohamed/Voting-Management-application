import Dachbord from './Components/Dashbord/Dachbord';
import './App.css';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import VotePage from './Components/Vote/VotePage';

function App() {
  return (
    <BrowserRouter>
      <div className="App">
        <Routes>
          <Route path="/" element={<Dachbord />} />
          <Route path="/vote/:voteId" element={<VotePage />} />
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
