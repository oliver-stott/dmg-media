import { __ } from "@wordpress/i18n";
import "./editor.scss";
import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { useState, useEffect } from "@wordpress/element";
import {
	PanelBody,
	TextControl,
	TextareaControl,
	Button,
} from "@wordpress/components";
import apiFetch from "@wordpress/api-fetch";
import { addQueryArgs } from "@wordpress/url";

export default function Edit({ attributes, setAttributes }) {
	const { title, description, searchInput } = attributes;
	const [posts, setPosts] = useState([]);
	const [loading, setLoading] = useState(false);
	const [error, setError] = useState(null);
	// Function to fetch posts
	const fetchPosts = (searchQuery) => {
		setLoading(true);
		setError(null); // Reset errors
		apiFetch({
			path: addQueryArgs("/wp/v2/posts", {
				search: searchQuery || "", // Only search if searchQuery is provided
				per_page: 10, // Default to 10 posts
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
			.catch((error) => console.error("Error fetching posts:", error))
			.finally(() => {
				setLoading(false);
			});
	};

	console.log(posts);

	// Fetch posts on initial load or when search input changes
	useEffect(() => {
		fetchPosts(searchInput);
	}, [searchInput]);

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

					{posts.length > 0 ? (
						<ul>
							{posts.map((post) => (
								<li key={post.id}>
									<Button isLink onClick={() => handlePostSelect(post)}>
										{post.title}
									</Button>
								</li>
							))}
						</ul>
					) : (
						<p>{__("No posts found.", "search-posts")}</p>
					)}
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}>
				<h1 className="search__title">{title}</h1>
				<p className="search__title">{description}</p>

				<div className="search__posts-wrapper">
					{posts.length > 0 ? (
						<ul className="search__posts">
							<li className="search__post">
								{posts.map((post) => (
									<p key={post.id} className="dmg-read-more">
										<a href={post.link} rel="noopener noreferrer">
											Read More: {post.title}
										</a>
									</p>
								))}
							</li>
						</ul>
					) : (
						<p>Sorry,No posts found</p>
					)}
				</div>
			</div>
		</div>
	);
}
