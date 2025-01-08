import Header from "./Header";
import VoteCard from "./VoteCard";
import 'animate.css';

export default function Home() {
    const data = [
        {
            id: 1,
            title: "Title 1",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/1",
        }, {
            id: 2,
            title: "Title 2",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/2",
        }, {
            id: 3,
            title: "Title 3",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/3",
        }, {
            id: 4,
            title: "Title 4",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/4",
        }, {
            id: 5,
            title: "Title 5",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/5",
        }, {
            id: 6,
            title: "Title 6",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/6",
        }, {
            id: 7,
            title: "Title 7",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/7",
        }, {
            id: 8,
            title: "Title 8",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/8",
        }, {
            id: 9,
            title: "Title 9",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/9",
        }, {
            id: 10,
            title: "Title 10",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/10",
        }, {
            id: 11,
            title: "Title 11",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/11",
        }, {
            id: 12,
            title: "Title 12",
            description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text",
            link: "http://localhost:3000/vote/12",
        }
    ];
    return (
        <>
            <Header/>
            <div className="container mx-auto p-6">
                <h1 className="text-3xl font-bold mb-4">
                    Public Polls
                </h1>
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 animate__animated animate__fadeIn">
                    {data.map((item) => (
                        <VoteCard
                            key={item.id}
                            id={item.id}
                            title={item.title}
                            description={item.description}
                            shareable_link={item.link}
                        />
                    ))}
                </div>
            </div>
        </>
    )
}