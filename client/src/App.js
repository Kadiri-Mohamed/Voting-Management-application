import Dachbord from './Components/Dashbord/Dachbord';
import './App.css';

import VotePage from './Components/Vote/VotePage';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Header from './Components/Dashbord/Header';
import Home from './Components/Dashbord/Home';
import Auth from './Components/auth/Auth.jsx';
import { useState } from 'react';
import { useSelector } from 'react-redux';

function App() {

  const islogged = useSelector((state) => state.isLogged);

  if (true) {
    return (
      <Routes>
        <Route path="/dashboard" element={<Dachbord />} />
        <Route path="/vote/:voteId" element={<VotePage />} />
        <Route path='/' element={<Home />} />
      </Routes>
    )
  }

  return (
    <Routes>
      <Route path="/*" element={<Auth />} />
      <Route path="/vote/:voteId" element={<VotePage />} />
    </Routes>
  );
}

export default App;
