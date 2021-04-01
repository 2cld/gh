# Create an Anvil with [Blender Guru](https://www.youtube.com/watch?v=7tdUxzhEy_E&list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a)

## Blender Intermediate Modelling Tutorial - [Part 1](https://www.youtube.com/embed/yi87Dap_WOc?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a)
<iframe src="https://www.youtube.com/embed/yi87Dap_WOc?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

1. [Setup workspace tc2:02](https://youtu.be/yi87Dap_WOc?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=122)
    - Get Anvil Reference [bg refernce.zip](https://drive.google.com/file/d/0B8PFSrI9B3iwcWt0ZWZOcFZveHM/view)
    - Load Anvil Image as reference
    - Delete everything in scene
    - Save as catanvil001.blend using "Save Copy"
2. [Start with plane tc4:11](https://youtu.be/yi87Dap_WOc?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=251)
    - I started with the default cube as when I used the plane I did not get the normals correct
    - Shift-A Mesh Plane (Cube)
    - Select cube object mode
    - g z 1 return - Grab z move 1 unit up
    - Alt-z (toggle on xray) 
    - Tab E (Toggle to Edit mode)
    - Select top plane
    - e z 2 (extrude up 2 units)
3. [Tappered Loop Cuts tc6:06](https://youtu.be/yi87Dap_WOc?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=366)
    - Shift-A Mesh Plane
    - Tab E (Toggle to Edit mode, Extrude) to make trunk
    - Cntrl R (Loop Cuts) then scroll wheel to create 12 loop cuts
4. [Prortional Edit the loop cuts tc6:38](https://youtu.be/yi87Dap_WOc?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=398)
    - Select 3rd from top loop cut
    - O toogle proportional editing
    - S scale Shift-Z to NOT scale loops in Z
    - Enter to keep
    - Save as catanvil014.blend using "Save Copy"
5. [Extrude top tc9:52](https://youtu.be/yi87Dap_WOc?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=592)
    - Select top plane
    - E Shift-Z -1 Extrude Z-axis -1 unit
    - Select left plane
    - E Shift-X -1 Extrude X-axis -1 unit
    - Cntrl R 1 Loop cut one
    - Select bottom left plane
    - G Z -.2 Move up .2 units in Z-axis only
6. [Extrude left and right sides tc10:11](https://youtu.be/yi87Dap_WOc?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=611)
    - Select right plane
    - E X 2 Extrude X-axis 2 units
    - Cntrl R 5 Loop cut one
    - Select top Loop cuts and Hide H
    - Set Propotional edit to sphere
    - Select bottom left edge to curl up
    - Alt H to unhide hidden verts
7. [Cleanup and save tc12:36](https://youtu.be/yi87Dap_WOc?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=756)
    - Save as catanvil017.blend using "Save Copy"
    - Save fixed normals as catanvil017-2.blend using "Save Copy"

## Blender Intermediate Modelling Tutorial - [Part 2](https://youtu.be/WxMwa0njGSM?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a)
<iframe src="https://www.youtube.com/embed/WxMwa0njGSM?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

1. [Boolean Cut object tc3:45](https://youtu.be/WxMwa0njGSM?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=225)
    - 7 top view
    - Shift-A m y enter  Add Mesh cYlinder 
    - g y -1.5 enter Grab selected y-axis Move -1.5 units 
2. [Boolean Cut Select tc3:53](https://youtu.be/WxMwa0njGSM?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=233)
    - Select object you want to keep first
    - Add Modifier (wrench icon) Boolean Operation Difference
    - Click on eyedroper then click on cylinder to select
3. [Mirror operation tc](https://youtu.be/WxMwa0njGSM?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=380)
    - Add Modifier Mirror
    - Need to loop cut and delete object y axis
    - 7 (top view) Tab (Edit mode) Select verts in pos y
    - Ctrl R (add loop cut at half) rght click enter
    - x (delete vertices) enter
4. [Save to another page before merge apply tc](https://youtu.be/WxMwa0njGSM?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=482)
    - Shift D (Duplicate)
    - M (Move)
    - Apply Boolean
    - Delete Cylinder
5. [Clean up mesh tc](https://youtu.be/WxMwa0njGSM?list=PLjEaoINr3zgHJVJF3T3CFUAZ6z11jKg6a&t=571)
    - Add Subsurface Modifier (just to see the mess)
    - k x click enter (Knife tool c to constrain click to edge)
    - select edge g g slide to good
    - a (select all) mesh -> cleanup -> merge by distance
    - merge any 3 point verts into 1
    - select verts alt-m to merge at center
    - ctrl R to loop cut from the vert
    - delete the face with 5 verts
    - add two faces with 4 verts
6. [ tc]()
    - Save fixed normals as catanvil026.blend using "Save Copy"


## Blender Intermediate Modelling Tutorial - [Part 3]()

1. [ tc]()
    - test
    - test
    - test
    - test
2. [ tc]()
    - test
    - test
    - test
    - test
3. [ tc]()
    - test
    - test
    - test
    - test
4. [ tc]()
    - test
    - test
    - test
    - test
5. [ tc]()
    - test
    - test
    - test
    - test
6. [ tc]()
7. [ tc]()

## Blender Intermediate Modelling Tutorial - [Part 4]()

1. [ tc]()
    - test
    - test
    - test
    - test
2. [ tc]()
    - test
    - test
    - test
    - test
3. [ tc]()
    - test
    - test
    - test
    - test
4. [ tc]()
    - test
    - test
    - test
    - test
5. [ tc]()
    - test
    - test
    - test
    - test
6. [ tc]()
7. [ tc]()

## Blender Intermediate Modelling Tutorial - [Part 5 - UV Unwrapping]()

1. [ tc]()
    - test
    - test
    - test
    - test
2. [ tc]()
    - test
    - test
    - test
    - test
3. [ tc]()
    - test
    - test
    - test
    - test
4. [ tc]()
    - test
    - test
    - test
    - test
5. [ tc]()
    - test
    - test
    - test
    - test
6. [ tc]()
7. [ tc]()

## Blender Intermediate Modelling Tutorial - [Part 6 Scuipt Details]()

1. [ tc]()
    - test
    - test
    - test
    - test
2. [ tc]()
    - test
    - test
    - test
    - test
3. [ tc]()
    - test
    - test
    - test
    - test
4. [ tc]()
    - test
    - test
    - test
    - test
5. [ tc]()
    - test
    - test
    - test
    - test
6. [ tc]()
7. [ tc]()

## Blender Intermediate Modelling Tutorial - [Part 7 Normals]()

1. [ tc]()
    - test
    - test
    - test
    - test
2. [ tc]()
    - test
    - test
    - test
    - test
3. [ tc]()
    - test
    - test
    - test
    - test
4. [ tc]()
    - test
    - test
    - test
    - test
5. [ tc]()
    - test
    - test
    - test
    - test
6. [ tc]()
7. [ tc]()

## Blender Intermediate Modelling Tutorial - [Texturing Part 1]()

1. [ tc]()
    - test
    - test
    - test
    - test
2. [ tc]()
    - test
    - test
    - test
    - test
3. [ tc]()
    - test
    - test
    - test
    - test
4. [ tc]()
    - test
    - test
    - test
    - test
5. [ tc]()
    - test
    - test
    - test
    - test
6. [ tc]()
7. [ tc]()

## Blender Intermediate Modelling Tutorial - [Texturing Part 2]()

1. [ tc]()
    - test
    - test
    - test
    - test
2. [ tc]()
    - test
    - test
    - test
    - test
3. [ tc]()
    - test
    - test
    - test
    - test
4. [ tc]()
    - test
    - test
    - test
    - test
5. [ tc]()
    - test
    - test
    - test
    - test
6. [ tc]()
7. [ tc]()

## Blender Intermediate Modelling Tutorial - [Texturing Part 3]()

1. [ tc]()
    - test
    - test
    - test
    - test
2. [ tc]()
    - test
    - test
    - test
    - test
3. [ tc]()
    - test
    - test
    - test
    - test
4. [ tc]()
    - test
    - test
    - test
    - test
5. [ tc]()
    - test
    - test
    - test
    - test
6. [ tc]()
7. [ tc]()
