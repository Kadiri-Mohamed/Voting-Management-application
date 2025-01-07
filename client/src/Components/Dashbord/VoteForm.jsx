import React from "react";

const VoteForm = () => {


 

  return (
    <div className=" bg-[#F0F4F8] flex items-center justify-end ">
      <div className="bg-[#F0F4F8] p-8 border-2 border-[#213555] rounded-lg shadow-lg w-full max-w-md">
        <h1 className="text-2xl font-bold text-[#3E5879] text-center mb-6">
          Create a Vote
        </h1>
        <form  className="space-y-4">
          
          <div>
            <label
              htmlFor="title"
              className="block text-sm font-medium text-[#213555] mb-1"
            >
              Title:
            </label>
            <input
              type="text"
              id="title"
              
              className="w-full px-4 py-2 border border-[#3E5879] rounded-lg focus:ring focus:ring-[#3E5879] focus:outline-none"
              placeholder="Enter the title"
              required
            />
          </div>

        
          <div>
            <label
              htmlFor="description"
              className="block text-sm font-medium text-[#213555] mb-1"
            >
              Description:
            </label>
            <textarea
              id="description"
          
              
              maxLength={200}
              className="w-full px-4 py-2 border border-[#3E5879] rounded-lg focus:ring focus:ring-[#3E5879] focus:outline-none"
              placeholder="Enter the description "
              rows="4"
              required
            ></textarea>
          </div>

        
          <button
            type="submit"
            className="w-full bg-[#213555] hover:bg-[#3E5879] text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring focus:ring-[#3E5879]"
          >
            Submit
          </button>
        </form>
      </div>
    </div>
  );
};

export default VoteForm;
