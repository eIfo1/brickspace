<?php
// If there is no ID then go back to dashboard

use brickspace\controller\UsersController;

$serverRoot = $_SERVER['DOCUMENT_ROOT'];
require($serverRoot . '/config/config.php');
header('Content-Type: application/json');

$statement = $conn->prepare("SELECT * FROM avatar where user_id = :id");
$statement->execute(array(':id' => $id));
$avatar = $statement->fetch();

if (!$avatar) {
  $user = UsersController::GetByID($conn, $id);
  if (!$user) {
    die(json_encode(["status" => "error", "error" => "User doesn't exist."]));
  }
  $statement = $conn->prepare("SELECT * FROM avatar WHERE user_id = :id");
  $statement->execute(array(':id' => $id));
  $avatar = $statement->fetch();
}


$statement = $conn->prepare("UPDATE users SET avatar_link  = :link WHERE user_id = :id");
$statement->execute(array(':link' => md5($id),  ':id' => $id));

$avatarImport = '
import bpy
import struct
from bpy import context
from mathutils import Euler
import math

bpy.ops.wm.open_mainfile(filepath="' . $serverRoot . '/renderer/res/avatar2.blend")
def hex_to_rgb(value):
    gamma = 2.05
    lv = len(value)
    fin = list(int(value[i:i + lv // 3], 16) for i in range(0, lv, lv // 3))
    r = pow(fin[0] / 255, gamma)
    g = pow(fin[1] / 255, gamma)
    b = pow(fin[2] / 255, gamma)
    fin.clear()
    fin.append(r)
    fin.append(g)
    fin.append(b)
    return tuple(fin)

';

$saveBoiler = '
for ob in bpy.context.scene.objects:
    if ob.type == "MESH":
        ob.select = True
        bpy.context.scene.objects.active = ob
    else:
        ob.select = False
bpy.ops.object.join()
bpy.ops.view3d.camera_to_view_selected()
origAlphaMode = bpy.data.scenes["Scene"].render.alpha_mode
bpy.data.scenes["Scene"].render.alpha_mode = "TRANSPARENT"
bpy.data.scenes["Scene"].render.alpha_mode = origAlphaMode
';

$colors = '
bpy.data.objects["Torso"].select = True
bpy.data.objects["Torso"].active_material.diffuse_color = hex_to_rgb("' . $avatar['torso_color'] . '")
bpy.data.objects["Head"].select = True
bpy.data.objects["Head"].active_material.diffuse_color = hex_to_rgb("' . $avatar['head_color'] . '")
bpy.data.objects["LeftArm"].select = True
bpy.data.objects["LeftArm"].active_material.diffuse_color = hex_to_rgb("' . $avatar['left_arm_color'] . '")
bpy.data.objects["RightArm"].select = True
bpy.data.objects["RightArm"].active_material.diffuse_color = hex_to_rgb("' . $avatar['right_arm_color'] . '")
bpy.data.objects["LeftLeg"].select = True
bpy.data.objects["LeftLeg"].active_material.diffuse_color = hex_to_rgb("' . $avatar['left_leg_color'] . '")
bpy.data.objects["RightLeg"].select = True
bpy.data.objects["RightLeg"].active_material.diffuse_color = hex_to_rgb("' . $avatar['right_leg_color'] . '")
';

if ($avatar['face'] != null) {
  $face = '
HeadImg = bpy.data.images.load(filepath="' . $serverRoot . '/res/textures/faces/' . $avatar['face'] . '.png")
HeadTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
HeadTex.image = HeadImg
Headslot = bpy.data.objects["Head"].active_material.texture_slots.add()
Headslot.texture = HeadTex';
} else {
  $face = '
HeadImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/face.png")
HeadTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
HeadTex.image = HeadImg
Headslot = bpy.data.objects["Head"].active_material.texture_slots.add()
Headslot.texture = HeadTex
  ';
}

$shirt = '';

if ($avatar['shirt'] != null) {
  $shirt = '
LeftArmImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/' . $avatar['shirt'] . '.png")
LeftArmTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
LeftArmTex.image = LeftArmImg
LeftArmslot = bpy.data.objects["LeftArm"].active_material.texture_slots.add()
LeftArmslot.texture = LeftArmTex
RightArmImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/' . $avatar['shirt'] . '.png")
RightArmTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
RightArmTex.image = RightArmImg
RightArmslot = bpy.data.objects["RightArm"].active_material.texture_slots.add()
RightArmslot.texture = RightArmTex
TorsoImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/' . $avatar['shirt'] . '.png")
TorsoTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
TorsoTex.image = TorsoImg
Torsolot = bpy.data.objects["Torso"].active_material.texture_slots.add()
Torsolot.texture = TorsoTex
';
}
$pants = '';

if ($avatar['pants'] != null) {
  $pants = '
LeftLegImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/' . $avatar['pants'] . '.png")
LeftLegTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
LeftLegTex.image = LeftLegImg
LeftLegslot = bpy.data.objects["LeftLeg"].active_material.texture_slots.add()
LeftLegslot.texture = LeftLegTex
RightLegImg = bpy.data.images.load(filepath="' . $serverRoot . '/cdn/img/' . $avatar['pants'] . '.png")
RightLegTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
RightLegTex.image = RightLegImg
RightLegslot = bpy.data.objects["RightLeg"].active_material.texture_slots.add()
RightLegslot.texture = RightLegTex
';
}

$hat = '';

if ($avatar['hat'] != null) {
  $hat = '
  hatpath = "' . $serverRoot . '/renderer/res/models/hats/' . $avatar['hat'] . '.obj"
  import_hat = bpy.ops.import_scene.obj(filepath=hatpath)
  hat = bpy.context.selected_objects[0]
  bpy.context.selected_objects[0].data.name = "hat"
  hatImg = bpy.data.images.load(filepath="' . $serverRoot . '/renderer/res/textures/hats/' . $avatar['hat'] . '.png")
  hatTex = bpy.data.textures.new("ColorTex", type = "IMAGE")
  hatTex.image = hatImg
  hatMat = bpy.data.materials.new("MaterialName")
  hatMat.diffuse_shader = "LAMBERT"
  hatSlot = hatMat.texture_slots.add()
  hatSlot.texture = hatTex
  hat.active_material = hatMat
  ';
}

$hat2 = '';

if ($avatar['hat2'] != null) {
  $hat2 = '
hatpath = "' . $serverRoot . '/renderer/res/models/hats/' . $avatar['hat'] . '.obj"
import_hat2 = bpy.ops.import_scene.obj(filepath=hat2path)
hat2 = bpy.context.selected_objects[0]
bpy.context.selected_objects[0].data.name = "hat2"
hatImg = bpy.data.images.load(filepath="' . $serverRoot . '/renderer/res/textures/hats/' . $avatar['hat'] . '.png")
hat2Tex = bpy.data.textures.new("ColorTex", type = "IMAGE")
hat2Tex.image = hat2Img
hat2Mat = bpy.data.materials.new("MaterialName")
hat2Mat.diffuse_shader = "LAMBERT"
hat2Slot = hat2Mat.texture_slots.add()
hat2Slot.texture = hat2Tex
hat2.active_material = hat2Mat
  ';
}



$save = '
bpy.data.scenes["Scene"].render.filepath = "' . $serverRoot . '/cdn/img/avatar/' . md5($id)  . '.png"
bpy.ops.object.select_all(action="SELECT")
bpy.ops.view3d.camera_to_view_selected()
bpy.ops.render.render( write_still=True )
';

$save_thumb = '
bpy.ops.object.select_all(action="SELECT")
bpy.ops.view3d.camera_to_view_selected()

obj = bpy.data.objects["Camera"]
obj.location.x = 2.19646
obj.location.y = -4.36904
obj.location.z = 8.64529

bpy.data.scenes["Scene"].render.filepath = "' . $serverRoot . '/cdn/img/avatar/thumbnail/' . md5($id)  . '.png"
bpy.ops.render.render( write_still=True )
';

$python = "
$avatarImport
$colors
$hat
$hat2
$shirt
$pants
$face
$saveBoiler
$save
";

$python_thumb = "
$avatarImport
$colors
$hat
$hat2
$shirt
$pants
$face
$saveBoiler
$save_thumb
";

$pyFileName = "" . $serverRoot . "/renderer/python/1.py";
$pyFileName_thumb = "" . $serverRoot . "/renderer/python/1_thumb.py";

file_put_contents($pyFileName, $python);
file_put_contents($pyFileName_thumb, $python_thumb);


// Weird issue where blender wont start on local servers if you dont have this line about the path in there
putenv('PATH=' . $_SERVER['PATH']);
//   run in back       script       server path                 link           file | other shit idk what does
$output = exec("blender --background -t 5 --python " . $_SERVER['DOCUMENT_ROOT'] . '/renderer/python/' .  "1.py -noaudio -nojoystick");
$output = exec("blender --background -t 5 --python " . $_SERVER['DOCUMENT_ROOT'] . '/renderer/python/' .  "1_thumb.py -noaudio -nojoystick");
die(json_encode(["status" => "ok"]));
