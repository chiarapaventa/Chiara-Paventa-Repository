----------------------------------------------------------------------------------
-- Company: 
-- Engineer: 
-- 
-- Create Date:    10:56:16 12/14/2017 
-- Design Name: 
-- Module Name:    FullAdder - Strutturale 
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

entity FullAdder is
    Port ( i0 : in  STD_LOGIC;
           i1 : in  STD_LOGIC;
           i2 : in  STD_LOGIC;
           s : out  STD_LOGIC;
           c : out  STD_LOGIC);
end FullAdder;

architecture Strutturale of FullAdder is
		component HalfAdder 
		port (i1,i0 : in STD_LOGIC;
		      s,c : out STD_LOGIC);
		end component;
		component OR
		port ( i0,i1 : in STD_LOGIC;
		           O : out STD_LOGIC);
		end component;
		signal aux1,aux2,aux3 : STD_LOGIC;
		
begin

h1 : HalfAdder
port map (i1=>i2, i0 => i1, s=> aux1, c=>aux2);
h2 : HalfAdder
port map (i1=>aux1, i0=>i0, s=>s, c=> aux3);
o1 : OR
port map (i0 =>aux2, i1=>aux3, o=>c);

end Strutturale;

