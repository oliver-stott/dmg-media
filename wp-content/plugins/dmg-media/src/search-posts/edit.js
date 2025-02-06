import { __ } from "@wordpress/i18n";
import "./editor.scss";
import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import {
	PanelBody,
	TextControl,
	TextareaControl,
	Button,
} from "@wordpress/components";
import { useEffect, useState } from "@wordpress/element";
import apiFetch from "@wordpress/api-fetch";
import { addQueryArgs } from "@wordpress/url";

export default function Edit({ attributes, setAttributes }) {
	const { title, description, searchInput, selectedPosts = [] } = attributes;
	const [posts, setPosts] = useState([]);
	const [loading, setLoading] = useState(false);
	const [error, setError] = useState(null);
	const [currentPage, setCurrentPage] = useState(1);

	// Function to fetch posts
	const fetchPosts = (searchQuery, currentPage) => {
		setLoading(true);
		setError(null); // Reset errors

		apiFetch({
			path: addQueryArgs("/wp/v2/posts", {
				search: searchQuery || "",
				per_page: 30,
				page: currentPage,
			}),
		})
			.then((data) => {
				const formattedPosts = data.map((post) => ({
					id: post.id,
					title: post.title.rendered,
					link: post.link,
				}));
				setPosts(formattedPosts);
			})
			.catch((error) => {
				setError("Error fetching posts.");
				console.log("Error Fetching Posts", error);
			})
			.finally(() => setLoading(false));
	};

	// Handle post selection
	const handlePostSelect = (post) => {
		if (selectedPosts.some(({ id }) => id === post.id)) return;
		setAttributes({ selectedPosts: [...selectedPosts, post] });
	};

	// Handle post removal
	const handlePostRemove = (postId) => {
		setAttributes({
			selectedPosts: selectedPosts.filter(({ id }) => id !== postId),
		});
	};

	const handleNextPage = () => {
		setCurrentPage(currentPage + 1);
	};

	const handlePreviousPage = () => {
		if (currentPage > 1) {
			setCurrentPage(currentPage - 1);
		}
	};

	useEffect(() => {
		if (searchInput) {
			fetchPosts(searchInput, currentPage);
		}
	}, [searchInput, currentPage]);

	return (
		<div>
			<InspectorControls>
				<PanelBody title={__("Content", "search-posts")}>
					<TextControl
						label={__("Title", "search-posts")}
						value={title}
						onChange={(value) => setAttributes({ title: value })}
					/>
					<TextareaControl
						label={__("Description", "search-posts")}
						value={description}
						onChange={(value) => setAttributes({ description: value })}
					/>
					<TextControl
						label={__("Search Input Text", "search-posts")}
						value={searchInput}
						onChange={(value) => setAttributes({ searchInput: value })}
					/>

					{loading ? (
						<p>{__("Loading...", "search-posts")}</p>
					) : error ? (
						<p>{error}</p>
					) : posts.length > 0 ? (
						<div>
							<ul>
								{posts.map((post) => (
									<li key={post.id}>
										<Button isLink onClick={() => handlePostSelect(post)}>
											{post.title}
										</Button>
									</li>
								))}
							</ul>

							<div className="pagination-controls">
								<Button
									disabled={currentPage === 1}
									onClick={handlePreviousPage}
								>
									Previous
								</Button>
								<Button onClick={handleNextPage}>Next</Button>
							</div>
						</div>
					) : (
						<p>{__("No posts found.", "search-posts")}</p>
					)}
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}>
				<h1 className="search__title">{title}</h1>
				<p className="search__description">{description}</p>

				<div className="search__posts-wrapper">
					<h3>{__("Selected Posts:", "search-posts")}</h3>
					{selectedPosts.length > 0 ? (
						<ul>
							{selectedPosts.map((post) => (
								<li key={post.id}>
									<a href={post.link} target="_blank" rel="noopener noreferrer">
										{post.title}
									</a>
									<Button
										isDestructive
										onClick={() => handlePostRemove(post.id)}
									>
										{__("Remove", "search-posts")}
									</Button>
								</li>
							))}
						</ul>
					) : (
						<p>{__("No posts selected.", "search-posts")}</p>
					)}
				</div>
			</div>
		</div>
	);
}
