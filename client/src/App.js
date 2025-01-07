import Dachbord from './Components/Dashbord/Dachbord';
import './App.css';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

function App() {
  return (
    <BrowserRouter>
      <div className="App">
        <Routes>
          <Route path="/" element={<Dachbord />} />
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
