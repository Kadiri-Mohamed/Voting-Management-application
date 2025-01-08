import React from "react";
const UserDetailsForm = (props) => {
    const [userName, setUserName] = React.useState(props.userName || "");
    const [email, setEmail] = React.useState(props.email || "");
    const [password, setPassword] = React.useState(null);
    const [confirmPassword, setConfirmPassword] = React.useState("");
    const [isFormModified, setIsFormModified] = React.useState(false);
    const [profilePicture, setProfilePicture] = React.useState(props.profilePicture || "https://tuk-cdn.s3.amazonaws.com/assets/components/avatars/a_3_7.png");

    const handlePasswordChange = (e) => {
        setPassword(e.target.value);
        setConfirmPassword("");
        setIsFormModified(true);
    };

    const handleConfirmPasswordChange = (e) => {
        setConfirmPassword(e.target.value);
        setIsFormModified(true);
    };

    const handleUserNameChange = (e) => {
        setUserName(e.target.value);
        setIsFormModified(true);
    };

    const handleEmailChange = (e) => {
        setEmail(e.target.value);
        setIsFormModified(true);
    };

    const handleProfilePictureChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                setProfilePicture(event.target.result);
                setIsFormModified(true);
            };
            reader.readAsDataURL(file);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        if (password && password !== confirmPassword) {
            alert("Passwords do not match");
            return;
        }

        if (isFormModified) {
            props.onFormSubmit({
                userName,
                email,
                password: password ? password : props.password,
                profilePicture,
            });
            setIsFormModified(false);
        } else {
            alert("No changes made");
        }
    };


    return (
        <div className="p-10 mt-5">
            <form className="flex align-middle justify-center items-center gap-10" onSubmit={handleSubmit}>
                <div className="flex flex-col items-center">
                    <div className="focus:outline-none h-24 w-24 mb-4">
                        <img
                            src={profilePicture}
                            alt="profile avatar"
                            className="h-full w-full rounded-full overflow-hidden shadow"
                        />
                    </div>
                    <div className="rounded-l-lg flex flex-col justify-center items-center ">
                        <label
                            className="cursor-pointer hover:opacity-80 inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                            htmlFor="profilePicture"
                        >
                            Select Image
                            <input
                                id="profilePicture"
                                type="file"
                                accept="image/*"
                                className="text-sm cursor-pointer w-36 hidden"
                                onChange={handleProfilePictureChange}
                            />
                        </label>
                    </div>
                </div>
                <div className="grid grid-cols-2 gap-8">
                    <div className="relative h-11 w-full min-w-[200px]">
                        <input
                            className="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-lightBlue focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" "
                            value={userName}
                            onChange={handleUserNameChange}
                        />
                        <label className="after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-lightBlue after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-lightBlue peer-focus:after:scale-x-100 peer-focus:after:border-lightBlue peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            {props.userName || "User Name"}
                        </label>
                    </div>

                    <div className="relative h-11 w-full min-w-[200px]">
                        <input
                            className="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-lightBlue focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" "
                            value={email}
                            type="email"
                            onChange={handleEmailChange}
                        />
                        <label className="after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-lightBlue after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-lightBlue peer-focus:after:scale-x-100 peer-focus:after:border-lightBlue peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            {props.email || "Email"}
                        </label>
                    </div>

                    <div className="relative h-11 w-full min-w-[200px]">
                        <input
                            className="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-lightBlue focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" "
                            type="password"
                            value={password}
                            onChange={handlePasswordChange}
                        />
                        <label className="after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-lightBlue after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-lightBlue peer-focus:after:scale-x-100 peer-focus:after:border-lightBlue peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            {"Password"}
                        </label>
                    </div>

                    {password && (
                        <div className="relative h-11 w-full min-w-[200px]">
                            <input
                                className="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-lightBlue focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" "
                                type="password"
                                value={confirmPassword}
                                onChange={handleConfirmPasswordChange}
                            />
                            <label className="after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-lightBlue after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-lightBlue peer-focus:after:scale-x-100 peer-focus:after:border-lightBlue peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                {"Confirm Password"}
                            </label>
                        </div>
                    )}
                </div>

                <button
                    type="submit"
                    disabled={!isFormModified}
                    className={`mt-4 p-2 rounded-md ${!isFormModified ? "bg-gray-400" : "bg-lightBlue"} text-white`}
                >
                    Update
                </button>
            </form>
        </div>
    );
};

export default UserDetailsForm;
