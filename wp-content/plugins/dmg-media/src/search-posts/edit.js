import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { PanelBody, TextControl } from "@wordpress/components";

import { __ } from "@wordpress/i18n";
import "./editor.scss";

export default function Edit({ attributes, setAttributes }) {
	const { title, description } = attributes;

	return (
		<div>
			<InspectorControls>
				<PanelBody title={__("Content", "search-posts")}>
					<TextControl
						label={__("Title", "search-posts")}
						value={title}
						onChange={(value) => setAttributes({ title: value })}
					/>
					<TextControl
						label={__("Description", "search-posts")}
						value={description}
						onChange={(value) => setAttributes({ description: value })}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...useBlockProps()}>
				<h1>{title}</h1>
				<p>{description}</p>
			</div>
		</div>
	);
}
