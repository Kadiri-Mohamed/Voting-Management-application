import React, { useState } from "react";

const VoteForm = () => {
  const [options, setOptions] = useState([""]);

  const handleOptionChange = (index, value) => {
    const updatedOptions = [...options];
    updatedOptions[index] = value;
    setOptions(updatedOptions);
  };

  const addOption = () => {
    setOptions([...options, ""]);
  };

  const removeOption = (index) => {
    const updatedOptions = options.filter((_, i) => i !== index);
    setOptions(updatedOptions);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log({
      title: e.target.title.value,
      description: e.target.description.value,
      options,
    });
    // Add your form submission logic here
  };

  return (
    <div className="bg-[#F0F4F8] flex items-center justify-center w-2/5">
      <div className="bg-[#F0F4F8] p-8 border-2 border-[#213555] rounded-lg shadow-lg w-full">
        <h1 className="text-2xl font-bold text-[#3E5879] text-center mb-6">
          Create a Vote
        </h1>
        <form onSubmit={handleSubmit} className="space-y-4">
          {/* Title Input */}
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
              name="title"
              className="w-full px-4 py-2 border border-[#3E5879] rounded-lg focus:ring focus:ring-[#3E5879] focus:outline-none"
              placeholder="Enter the title"
              required
            />
          </div>

          {/* Description Input */}
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
              name="description"
              className="w-full px-4 py-2 border border-[#3E5879] rounded-lg focus:ring focus:ring-[#3E5879] focus:outline-none"
              placeholder="Enter the description"
              rows="4"
              required
            ></textarea>
          </div>

          {/* Dynamic Options */}
          <div>
            <label
              htmlFor="options"
              className="block text-sm font-medium text-[#213555] mb-1"
            >
              Options:
            </label>
            {options.map((option, index) => (
              <div key={index} className="flex items-center mb-2 space-x-2">
                <input
                  type="text"
                  value={option}
                  onChange={(e) => handleOptionChange(index, e.target.value)}
                  className="w-full px-4 py-2 border border-[#3E5879] rounded-lg focus:ring focus:ring-[#3E5879] focus:outline-none"
                  placeholder={`Option ${index + 1}`}
                  required
                />
                {options.length > 1 && (
                  <button
                    type="button"
                    onClick={() => removeOption(index)}
                    className="bg-red-500 hover:bg-red-600 text-white font-semibold px-2 py-1 rounded-lg focus:outline-none focus:ring focus:ring-red-400"
                  >
                    Remove
                  </button>
                )}
              </div>
            ))}
            <button
              type="button"
              onClick={addOption}
              className="mt-2 bg-[#213555] hover:bg-[#3E5879] text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring focus:ring-[#3E5879]"
            >
              Add Option
            </button>
          </div>

          {/* Submit Button */}
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
