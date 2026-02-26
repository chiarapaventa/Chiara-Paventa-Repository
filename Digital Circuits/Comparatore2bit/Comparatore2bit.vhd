----------------------------------------------------------------------------------
-- Company: 
-- Engineer: 
-- 
-- Create Date:    10:54:42 12/03/2017 
-- Design Name: 
-- Module Name:    Comparatore2bit - Behavioral 
-- Project Name: 
-- Target Devices: 
-- Tool versions: 
-- Description: 
--
-- Dependencies: 
--
-- Revision: 
-- Revision 0.01 - File Created
-- Additional Comments: 
--
----------------------------------------------------------------------------------
library IEEE;
use IEEE.STD_LOGIC_1164.ALL;

-- Uncomment the following library declaration if using
-- arithmetic functions with Signed or Unsigned values
--use IEEE.NUMERIC_STD.ALL;

-- Uncomment the following library declaration if instantiating
-- any Xilinx primitives in this code.
--library UNISIM;
--use UNISIM.VComponents.all;

entity Comparatore2bit is
    Port ( in1 : in  STD_LOGIC;
           in2 : in  STD_LOGIC;
           output : out  STD_LOGIC);
end Comparatore2bit;

architecture Behavioral of Comparatore2bit is

begin
output <= (in1 and in2) or (not in1 and not in2);

end Behavioral;

