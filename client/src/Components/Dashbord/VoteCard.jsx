import { Link } from "react-router-dom";
import React from "react"

const VoteCard = (props) => {

    return (
        <Link to={`/vote/${props.id}`}>
            <div className=" mt-6 flex w-72 flex-col max-h-52 rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                <div className="p-6">
                    <h5 className="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                        {props.title ? props.title : "Title"}
                    </h5>
                    <p className="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                        {props.description ? props.description : "Description"}
                    </p>
                </div>
            </div>
        </Link>
    )
};

export default VoteCard;
