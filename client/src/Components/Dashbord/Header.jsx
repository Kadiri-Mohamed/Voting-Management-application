import NavList from "./NavList";

export default function Header() {
    return (
        <header className="bg-gray-200 p-4">
            <nav className="flex items-center justify-between">
                <img src="logo_Vote.png" alt="Logo" className="w-12 h-auto" />
                <NavList />
                <button className="bg-darkBlue text-white px-4 py-2 rounded hover:bg-blue-900">
                    Log Out
                </button>
            </nav>
        </header>
    );
}
