import Header from "./Header";
import UserDetailsForm from "./UserDetailsForm";
import VoteCard from "./VoteCard";
import VoteForm from "./VoteForm";
import React, { useEffect } from "react"

const Dachbord = (props) => {
    const [userVotes, setUserVotes] = React.useState([]);
    const userId = 1; //TODO: get user id from session or useParams
    useEffect(() => {
        try {
            // fetch(`http://localhost/server/index.php?action=getPollsByUserId&id=${userId}`).then(res => res.json()).then(data => setUserVotes(data.pool));
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
                        {
                            //mapping through the votes
                            userVotes.map((vote) => (
                                <VoteCard key={vote.id} vote={vote.title} description={vote.description} link={vote.link}/>
                            ))
                        }
                    </div>
                    <VoteForm   />
                </div>
            </div>
        </>
    )
};

export default Dachbord;
