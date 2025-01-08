import Header from "./Header";
import UserDetailsForm from "./UserDetailsForm";
import VoteCard from "./VoteCard";
import VoteForm from "./VoteForm";
import React from "react"

const Dachbord = (props) => {

    return (
        <>
            <Header/>
            <div className="container mx-auto p-4">
            <div className=" flex justify-between">
                <div className=" w-4/5 ">
                    <UserDetailsForm />
                    {
                        //mapping through the votes
                    }
                    <VoteCard />
                </div>
                <VoteForm />
            </div>
        </div>
        </>
    )
};

export default Dachbord;
