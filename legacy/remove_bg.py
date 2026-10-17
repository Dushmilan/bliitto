from PIL import Image

def remove_outer_white(input_path, output_path, tolerance=240):
    img = Image.open(input_path).convert("RGBA")
    width, height = img.size
    
    # We will use flood fill to find all contiguous near-white pixels starting from corners
    
    # Create a mask initialized to 0 (black)
    mask = Image.new('L', (width, height), 0)
    
    pixels = img.load()
    mask_pixels = mask.load()
    
    def is_white(x, y):
        r, g, b, a = pixels[x, y]
        return r > tolerance and g > tolerance and b > tolerance and a > 0
    
    stack = [(0, 0), (width-1, 0), (0, height-1), (width-1, height-1)]
    visited = set()
    
    while stack:
        x, y = stack.pop()
        if (x, y) in visited:
            continue
        visited.add((x, y))
        
        if x < 0 or x >= width or y < 0 or y >= height:
            continue
            
        if is_white(x, y):
            mask_pixels[x, y] = 255
            stack.append((x+1, y))
            stack.append((x-1, y))
            stack.append((x, y+1))
            stack.append((x, y-1))

    # Now apply the mask: if mask is 255, make it transparent
    for y in range(height):
        for x in range(width):
            if mask_pixels[x, y] == 255:
                r, g, b, a = pixels[x, y]
                pixels[x, y] = (r, g, b, 0)
                
    img.save(output_path, "PNG")

if __name__ == "__main__":
    import sys
    remove_outer_white(sys.argv[1], sys.argv[2])
