<?php
class CodexToHtml {
    
    private $templates = null;
    private $beautify = false;

    function __construct($templates, $beautify) {
        $this->templates = $templates;
        $this->beautify = $beautify;
    }

    public function render($blocks) {
        $result = [];

        foreach ((array) $blocks as $block) {
            if (array_key_exists($block['type'], $this->templates)) {
                $template = $this->templates[$block['type']];
                $data = $block['data'];
                $result[] = call_user_func_array($template, $data);
            }
        }

        $html = implode($result);
        
        return $html;
    }
    
}

if (!function_exists("codex2html")) {
    function codex2html($blocks)
    {
		$codex = new CodexToHtml([
			"raw" => function($html) {
				return $html;
			},
			"header" => function($text, $level) {
				return "<h{$level}>{$text}</h{$level}>";
			},
			"paragraph" => function($text) {
				return "<p>{$text}</p>";
			},
			"delimiter" => function() {
				return "<div class=\"delimiter\"></div>";
			},
			"list" => function($style, $items) {
				$tag = $style == "ordered" ? "ol" : "ul";
				$lis = ""; // <li>s
				foreach($items as $item) {
					$lis .= "\n<li>$item</li>";
				}
				return "
				<$tag class=\"\">
					$lis
				</$tag>
				";
			},
			"image" => function($file, $caption, $withBorder, $stretched, $withBackground) {
				$attributes = $stretched ? "w-100" : "mw-100 mx-auto";
				if ($withBorder)
					$attributes  .= " border rounded-sm";
				
				$figcaption = !in_array($caption, ["", "<br>"]) ? 
					"<figcaption class=\"img-caption\">$caption</p>" : "";
				$figAttributes = $withBackground ? "bg-light" : "";
				
				return "
				<figure class=\"$figAttributes\">
					<img src=\"{$file['url']}\" title=\"{$caption}\" alt=\"{$caption}\" class=\"{$attributes}\">
					$figcaption
				</figure>";
			},
			"quote" => function($text, $author, $alignment) {
				$alignClass = $alignment == "center" ? "mx-auto" : "mr-auto";
				return "
				<div class=\"quote $alignClass\">
					<blockquote>
						<p>{$text}</p>
					</blockquote>
					<p class=\"author\">{$author}</p>
				</div>
				";
			},
			"warning" => function($title, $message) {
				return "
				<p class=\"note note-light\">
					<strong>$title</strong> $message
				</p>
				";
			},
			"embed" => function($service, $source, $embed, $width, $height, $caption) {
				return "
				<div class=\"embed\">
					<iframe width=\"{$width}\" height=\"{$height}\" src=\"{$embed}\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>
				</div>
				";
			},
		], true);

		return $codex->render($blocks);
    }
}