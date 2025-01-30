import { useEffect, useState } from "react";
import Header from "./Header";
import VoteCard from "./VoteCard";
import 'animate.css';

export default function Home() {
    
    const [data , setData] = useState([]);
   
    useEffect(() => {
        try {
            fetch(`http://localhost:8000/index.php?action=getPublicPolls`).then(res => res.json()).then(data => setData(data.publicpoll || []));
        } catch (err) {
            console.log(err);
        }
    }, [])
   
    return (
        <>
            <Header/>
            <div className="container mx-auto p-6">
                <h1 className="text-3xl font-bold mb-4">
                    Public Polls
                </h1>
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 ">
                    {data.map((item , index) => (
                        <VoteCard
                        className={`animate__animated animate__fadeIn animate__delay-${Math.round(( index +1) *0.8)}s`}
                            key={item.id}
                            id={item.id}
                            title={item.title}
                            description={item.description}
                            shareable_link={item.link}
                        />
                    ))}
                </div>
            </div>
        </>
    )
}