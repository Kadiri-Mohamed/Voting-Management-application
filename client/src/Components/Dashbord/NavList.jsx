import { NavLink } from "react-router-dom";

export default function NavList() {
    return (
        <ul className="flex space-x-6">
            <li>
                <NavLink to={'/'} className="text-gray-700 font-semibold hover:text-blue-500">
                    Home
                </NavLink>
            </li>
            <li>
                <NavLink to={'/dashboard'} className="text-gray-700 font-semibold hover:text-blue-500">
                    Dashboard
                </NavLink>
            </li>
        </ul>
    );
}
