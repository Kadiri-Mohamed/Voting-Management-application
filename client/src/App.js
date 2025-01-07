import Dachbord from './Components/Dashbord/Dachbord';
import './App.css';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Header from './Components/Dashbord/Header';
import Home from './Components/Dashbord/Home';

function App() {
  return (
    <BrowserRouter>
      <div className="App">
        <Header />
        <Routes>
          <Route path='/home' element={<Home />} />
          <Route path="/" element={<Dachbord />} />
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
