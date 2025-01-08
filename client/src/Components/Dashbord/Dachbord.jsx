import UserDetailsForm from "./UserDetailsForm";
import VoteCard from "./VoteCard";
import VoteForm from "./VoteForm";
import React from "react"

const Dachbord = (props) => {

    return (
        <div className="container mx-auto p-4">
            <UserDetailsForm />
            <div className=" grid grid-cols-2 gap-4">
                <div className=" grid grid-cols-2 gap-4">
                {
                    //mapping through the votes
                }
                    <VoteCard />
                </div>
                <VoteForm />
            </div>
        </div>
    )
};

export default Dachbord;
