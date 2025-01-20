import { useState } from "react";

export default function Auth() {



    



    const [left, setLeft] = useState("0vw");
    const scroll = () => {
        setLeft("-50vw")
    }
    const unScroll = ()=>{
        setLeft("0vw")
    }
    return (
        <div className="overflow-hidden">
            <div
            style={{
                left: left,
                transition: "left 0.5s ease-in-out",
            }}
            className="flex relative flex-row items-center w-[150vw] overflow-hidden justify-center gap-8 h-screen"
        >
            <form
                action=""
                className="flex flex-col gap-6 items-center flex-shrink-0 justify-center w-[50vw] "
            >
                <h1 className=" text-5xl my-5">Sign Up</h1>
                <div className="relative h-14 w-3/5">
                    <input
                        className="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-lightBlue focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        placeholder=" "
                    />
                    <label className="after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-lightBlue after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-lightBlue peer-focus:after:scale-x-100 peer-focus:after:border-lightBlue peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        User Name
                    </label>
                </div>
                <div className="relative h-14 w-3/5">
                    <input
                        className="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-lightBlue focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        placeholder=" "
                    />
                    <label className="after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-lightBlue after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-lightBlue peer-focus:after:scale-x-100 peer-focus:after:border-lightBlue peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Password
                    </label>
                </div>
                <div className="relative h-14 w-3/5">
                    <input
                        className="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-lightBlue focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        placeholder=" "
                    />
                    <label className="after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-lightBlue after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-lightBlue peer-focus:after:scale-x-100 peer-focus:after:border-lightBlue peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Confirm Password
                    </label>
                </div>

                <p>Already have an account ?<span onClick={scroll} className=" font-bold cursor-pointer "> sign in</span></p>
                <input
                    type="submit"
                    value="Submit"
                    className="h-14 w-2/5 bg-darkBlue font-semibold rounded-lg text-white hover:bg-lightBlue cursor-pointer"
                />
            </form>
            <div className="flex w-[50vw] items-end flex-shrink-0 justify-end flex-col h-full">
                <img src="auth.png" alt="" className="max-w-full h-auto" />
            </div>
            <form
                action=""
                className="flex flex-col  gap-6 items-center flex-shrink-0 justify-center w-[50vw] "
            >
                <h1 className=" text-5xl my-5">Login</h1>
                <div className="relative h-14 w-3/5">
                    <input
                        className="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-lightBlue focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        placeholder=" "
                    />
                    <label className="after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-lightBlue after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-lightBlue peer-focus:after:scale-x-100 peer-focus:after:border-lightBlue peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        User Name
                    </label>
                </div>
                <div className="relative h-14 w-3/5">
                    <input
                        className="peer h-full w-full border-b border-blue-gray-200 bg-transparent pt-4 pb-1.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-lightBlue focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        placeholder=" "
                    />
                    <label className="after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-500 transition-all after:absolute after:-bottom-1.5 after:block after:w-full after:scale-x-0 after:border-b-2 after:border-lightBlue after:transition-transform after:duration-300 peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[4.25] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-lightBlue peer-focus:after:scale-x-100 peer-focus:after:border-lightBlue peer-disabled:text-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                        Password
                    </label>
                </div>
                <p>don't have an account ?<span onClick={unScroll} className=" font-bold cursor-pointer "> sign up</span></p>
                <input
                    type="submit"
                    value="Submit"
                    className="h-14 w-2/5 bg-darkBlue font-semibold rounded-lg text-white hover:bg-lightBlue cursor-pointer"
                />

            </form>

        </div>
        </div>
    );
}
