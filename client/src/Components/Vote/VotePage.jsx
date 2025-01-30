import React, { useEffect, useRef, useState } from 'react';
import { useParams } from 'react-router-dom';
import confetti from 'canvas-confetti';
import 'animate.css';
import { useSelector } from 'react-redux';

function VotePage() {
	const { voteId } = useParams();
	const [vote, setVote] = useState({});
	const [option, setOption] = useState(null);
	const [prevOption, setPrevOption] = useState(null);
	const [copied, setCopied] = useState(false);
	const user = useSelector(state => state.user);
	const fetchdata = () => {
		try {
			fetch(`http://localhost:8000/index.php?action=poll&id=${voteId}`).then(res => res.json()).then(data => setVote(data.poll || []));
		} catch (err) {
			console.log(err);
		}
	}
	useEffect(() => {
		fetchdata()
	}, [])




	var colors = ['#3E5879', '#D8C4B6'];

	var end = Date.now() + ( 1000);

	const frame = () => {
		confetti({
			particleCount: 2,
			angle: 60,
			spread: 55,
			origin: { x: 0 },
			colors: colors
		});
		confetti({
			particleCount: 2,
			angle: 120,
			spread: 55,
			origin: { x: 1 },
			colors: colors
		});

		if (Date.now() < end) {
			requestAnimationFrame(frame);
		}
	};

	const handleChange = (e) => {
		const selectedOptionId = parseInt(e.target.value); // Get the selected option ID
		setOption(selectedOptionId);

		let formdata = new FormData();
		formdata.append('user_id', user?.user_id || 0);
		formdata.append('option_id', selectedOptionId);
		formdata.append('poll_id', voteId);

		fetch('http://localhost:8000/?action=Vote', {
			method: 'POST',
			body: formdata
		}).then((data) => data.json()).then((data) => {
			if (data.status == 'success') {
				frame();
			}
		});
		fetchdata()
	};



	

	const totalVotes = vote?.options?.reduce((sum, option) => sum + option?.votes, 0) || 1;

	const generateShareLink = async () => {
		const shareLink = `${window.location.origin}/vote/${voteId}`;
		await navigator.clipboard.writeText(shareLink);

		setCopied(true);
		setTimeout(() => setCopied(false), 2000);

	}
	return (
		<section className='bg-slate-200 '>
			<div className="container mx-auto min-h-screen">
				<h1 className="text-6xl p-5 text-white font-outline-1 font-bold text-center ">Welcome to the vote page</h1>
				<div className="mt-6 p-5 flex max-w-6xl mx-auto flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
					<div className="p-6">
						<h5 className="mb-2 block font-sans text-5xl text-center font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
							{vote?.title}
						</h5>
						<p className="block text-4xl font-sans text-center font-light leading-relaxed text-inherit antialiased">
							{vote?.description}
						</p>
					</div>
					<div className="flex mb-10 gap-5 flex-col mx-auto w-1/2 items-center justify-center">
						{vote?.options ? vote.options.map((option, index) => {
							const percentage = (option.vote_count / totalVotes) * 100;
							return (
								<div key={option.id} className="flex w-full">
									<input
										type="radio"
										className='mr-2 scale-150 accent-darkBlue'
										name='option'
										id={option.option_id}
										value={option.option_id}
										onChange={handleChange}
									/>
									<div className="flex w-full flex-col justify-center items-start">
										<div className="flex justify-between w-full">
											<h5 className="mb-2 block font-sans text-xs font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
												{option.option_text}
											</h5>
											<h5 className="mb-2 block font-sans text-xs font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
												{option.votes}
											</h5>
										</div>
										<div className="flex w-full bg-slate-200 h-3 overflow-hidden rounded-lg ">
											<div className={`flex justify-center items-center rounded-lg bg-lightBlue`} style={{ width: `${percentage}%` }}>
											</div>
										</div>
									</div>
								</div>
							);
						}) : ""}
					</div>
					<button className=' relative flex gap-2 items-center justify-end m-5' onClick={generateShareLink}>
						Share this poll
						{copied &&
							<span className="absolute -top-10 right-0 text-xs text-white bg-green-500 p-2 rounded shadow-lg animate__animated animate__bounceIn animate__faster">
								Copied!
								<span className="absolute bottom-[-5px] left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[6px] border-transparent border-t-green-500 "></span>
							</span>
						}
						<img src="/icons/share.svg" alt="" className='h-5 w-5 object-contain' />
					</button>
				</div>
			</div>
		</section>
	);
}

export default VotePage;
