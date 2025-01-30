import { useSelector } from "react-redux";
import Header from "./Header";
import UserDetailsForm from "./UserDetailsForm";
import VoteCard from "./VoteCard";
import VoteForm from "./VoteForm";
import React, { useEffect, useState } from "react"

const Dachbord = (props) => {
    const [userVotes, setUserVotes] = useState([]);
    const user = useSelector((state) => state.user) //TODO: get user id from session or useParams
    useEffect(() => {
        try {
            fetch(`http://localhost:8000/index.php?action=getPollsByUserId&user_id=${user.user_id}`).then(res => res.json()).then(data => setUserVotes(data.poll || []));
        } catch (err) {
            console.log(err);
        }
    }, [])

    return (
        <>
            <Header />
            <div className="container mx-auto p-4">
                <div className=" flex justify-between">
                    <div className=" w-4/5 ">
                        <UserDetailsForm />
                        <div className="flex flex-wrap justify-between mx-4">

                            {
                                userVotes.map((vote) => (
                                    <VoteCard key={vote.id} vote={vote.title} description={vote.description} shareable_link={vote.shareable_link} />
                                ))
                            }
                        </div>
                    </div>
                    <VoteForm />
                </div>
            </div>
        </>
    )
};

export default Dachbord;
